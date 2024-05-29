<?php

namespace App\Modules\Input\Jobs;

use finfo;
use App\Helpers\ParseCsvToArr;
use App\Modules\Input\Enums\InputStatus;
use App\Modules\Input\Models\Input;
use App\Modules\Input\Models\InputDocument;
use App\Modules\Input\Repositories\InputRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class ProccessInputDocumentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Input $input;

    /**
     * Create a new job instance.
     */
    public function __construct(Input $input)
    {
        $this->input = $input;
    }

    /**
     * Execute the job.
     */
    public function handle(InputRepositoryInterface $repo): void
    {
        $repo->updateStatus($this->input, InputStatus::PROCESSING);

        $file_path = storage_path('app/' . $this->input->storage_document_path);
        $finfo = new finfo(FILEINFO_MIME_TYPE);

        if (Storage::exists($this->input->storage_document_path)) {
            $file = new UploadedFile(
                $file_path,
                $this->input->storage_document_path,
                $finfo->file($file_path),
                0,
                false
            );

            $items = collect(ParseCsvToArr::parse($file));

            $items = $items->map(function ($item) {
                $item['id'] = Uuid::uuid4();
                $item['Input_id'] = $this->input->id;
                return $item;
            });

            DB::beginTransaction();

            try {
                foreach ($items->chunk(8000) as $chunk) {
                    DB::table(InputDocument::TABLE)->insert($chunk->toArray());
                }

                Log::info(count($items) . ' documents dispatched for the input ' . $this->input->id);
                Storage::delete($this->input->storage_document_path);
                DB::commit();
                $repo->updateStatus($this->input, InputStatus::COMPLETED);
            } catch (\Exception $err) {
                Log::error($err);
                DB::rollBack();
                $repo->updateStatus($this->input, InputStatus::ERROR);
                throw $err;
            }
        }
    }
}

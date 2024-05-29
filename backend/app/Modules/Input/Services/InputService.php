<?php

namespace App\Modules\Input\Services;

use App\Modules\Input\Dtos\ProccessDocumentInput;
use App\Modules\Input\Jobs\ProccessInputDocumentJob;
use App\Modules\Input\Models\Input;
use App\Modules\Input\Repositories\InputRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class InputService implements InputServiceInterface
{
    public function __construct(private readonly InputRepositoryInterface $repo)
    {
    }

    public function getLastInputs(): array
    {
        return $this->repo->getLastInputs();
    }

    public function proccessDocument(ProccessDocumentInput $input): Input
    {
        try {

            Storage::put($input->storageDocumentPath, file_get_contents($input->document->getRealPath()));
            $input = $this->repo->createInput($input);
            dispatch(new ProccessInputDocumentJob($input));
            return $input;
        } catch (\Exception $err) {

            throw $err;
        }
    }
}

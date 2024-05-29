<?php

namespace App\Modules\Input\Dtos;

use App\Modules\Input\Enums\InputStatus;
use Illuminate\Http\UploadedFile;
use Ramsey\Uuid\Uuid;

class ProccessDocumentInput
{
    public string $name;
    public ?string $description;
    public UploadedFile $document;
    private  InputStatus $status;
    public string $storageDocumentPath;

    public function __construct(mixed $data)
    {
        $this->name = $data['name'];
        $this->description = isset($data['description']) ? $data['description'] : null;
        $this->document = $data['document'];
        $this->status = InputStatus::PENDING;
        $this->storageDocumentPath = 'inputs/' . Uuid::uuid4() . '.csv';
    }

    public function data()
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'document' => $this->document,
            'status' => $this->status,
            'storage_document_path' => $this->storageDocumentPath,
        ];
    }
}

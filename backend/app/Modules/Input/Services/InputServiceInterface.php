<?php

namespace App\Modules\Input\Services;

use App\Modules\Input\Dtos\ProccessDocumentInput;
use App\Modules\Input\Models\Input;

interface InputServiceInterface
{
    public function getLastInputs(): array;

    public function proccessDocument(ProccessDocumentInput $input): Input;
}

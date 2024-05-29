<?php

namespace App\Modules\Input\Repositories;

use App\Modules\Input\Dtos\ProccessDocumentInput;
use App\Modules\Input\Enums\InputStatus;
use App\Modules\Input\Models\Input;

interface InputRepositoryInterface
{
    /**
     * @return array<Input>
     */
    public function getLastInputs(): array;

    public function createInput(ProccessDocumentInput $input): Input;

    public function updateStatus(Input $input, InputStatus $status): void;
}

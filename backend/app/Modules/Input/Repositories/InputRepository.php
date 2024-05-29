<?php

namespace App\Modules\Input\Repositories;

use App\Modules\Input\Dtos\ProccessDocumentInput;
use App\Modules\Input\Enums\InputStatus;
use App\Modules\Input\Models\Input;

class InputRepository implements InputRepositoryInterface
{
    public function __construct(private readonly Input $entity)
    {
    }

    /**
     * @return array<Input>
     */
    public function getLastInputs(): array
    {
        return $this->entity->get()->toArray();
    }

    public function createInput(ProccessDocumentInput $input): Input
    {
        return $this->entity->create($input->data());
    }

    public function updateStatus(Input $input, InputStatus $status): void
    {
        $input->status = $status;
        $input->save();
    }
}

<?php

namespace App\Modules\Input\Http\Controllers;

use App\Helpers\ParseCsvToArr;
use App\Modules\Input\Services\InputServiceInterface;
use App\Http\Controllers\Controller;
use App\Modules\Input\Dtos\ProccessDocumentInput;
use App\Modules\Input\Http\Requests\ProcessDocumentsRequest;

class InputController extends Controller
{
    public function __construct(private readonly InputServiceInterface $service)
    {
    }

    public function index()
    {
        return $this->service->getLastInputs();
    }

    public function proccessDocument(ProcessDocumentsRequest $request)
    {
        $input = new ProccessDocumentInput($request->validated());

        return $this->service->proccessDocument($input);
    }
}

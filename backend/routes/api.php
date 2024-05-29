<?php

use App\Modules\Input\Http\Controllers\InputController;
use Illuminate\Support\Facades\Route;

Route::get('inputs', [InputController::class, 'index']);
Route::post('inputs/proccess-document', [InputController::class, 'proccessDocument']);

<?php

namespace App\Modules\Input\Enums;

enum InputStatus: string
{
    case PENDING = 'pending';
    case PROCESSING = 'processing';
    case ERROR = 'error';
    case COMPLETED = 'completed';
}

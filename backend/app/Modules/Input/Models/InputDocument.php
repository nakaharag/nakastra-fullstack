<?php

namespace App\Modules\Input\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InputDocument extends Model
{
    const TABLE = 'input_documents';

    use HasFactory, HasUuids;

    protected $fillable = [
        'input_id',
        'name',
        'government_id',
        'email',
        'debt_amount',
        'debt_due_date',
        'debt_id',
    ];

    protected function casts(): array
    {
        return [
            'debt_amount' => 'integer',
            'debt_due_date' => 'datetime',
        ];
    }

    public function input(): BelongsTo
    {
        return $this->belongsTo(Input::class, 'input_id');
    }
}

<?php

namespace App\Modules\Input\Models;

use App\Modules\Input\Enums\InputStatus;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Input extends Model
{
    use HasFactory, HasUuids;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('created_at', 'desc');
        });
    }

    protected $fillable = [
        'name',
        'description',
        'storage_document_path',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => InputStatus::class,
        ];
    }

    public function documents(): HasMany
    {
        return $this->hasMany(InputDocument::class, 'input_id');
    }
}

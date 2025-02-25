<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Parameter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'code', 'description', 'product_id', 'type', 'unit', 'default_value',
        'is_required', 'is_filterable', 'is_visible',
        'sort_order', 'status', 'name_translations', 'description_translations',
        'min_value', 'max_value', 'validation_rules',
    ];

    protected $casts = [
        'is_required' => 'boolean',
        'is_filterable' => 'boolean',
        'is_visible' => 'boolean',
        'name_translations' => 'array',
        'description_translations' => 'array',
        'validation_rules' => 'array',
        'min_value' => 'float',
        'max_value' => 'float',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function getName(): string
    {
        return $this->name_translations[app()->getLocale()] ?? $this->name;
    }

    public function getDescription(): string
    {
        return $this->description_translations[app()->getLocale()] ?? $this->description;
    }

    public function getRange(): string|false
    {
        if ($this->min_value !== null && $this->max_value !== null) {
            return "{$this->min_value} - {$this->max_value} {$this->unit}";
        }

        return false;
    }

    public function getValidationRules(): array
    {
        return $this->validation_rules ?? [];
    }
}

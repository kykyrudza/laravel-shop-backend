<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'status',
        'sort_order',
        'parent_id'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::saved(fn () => Cache::forget('categories_all'));
        static::deleted(fn () => Cache::forget('categories_all'));
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id')->withDefault(); // Если нет родителя, вернет пустой объект
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(CategoryImage::class, 'category_id');
    }
}

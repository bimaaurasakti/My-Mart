<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_category_id',
        'name'
    ];

    protected $with = [
        'items',
        'parent'
    ];

    public function items(): HasMany
    {
        return $this->hasMany(Item::class, 'item_category_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(ItemCategory::class, 'parent_category_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(ItemCategory::class, 'parent_category_id');
    }

    public function getIsUsedAttribute() {
        return (count($this->items()->get()) > 0 || count($this->children()->get()) > 0);
    }
}

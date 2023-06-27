<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Restaurant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'address',
        'location',
        'phone_number',
        'tax',
        'vat',
        'user_id',
    ];

    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class, 'restaurant_id', 'id');
    }

    public function tables(): HasMany
    {
        return $this->hasMany(Table::class, 'restaurant_id', 'id');
    }

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

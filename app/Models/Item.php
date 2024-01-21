<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Price lists relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function price_lists(): HasMany
    {
        return $this->hasMany(PriceList::class);
    }
    public function transactions()
    {
        return $this->belongsToMany(Transaction::class, 'item_transactions','transaction_id', 'item_id')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}

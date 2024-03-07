<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Ramsey\Uuid\Uuid;

class MemberTransaction extends Model
{
    protected $fillable = [
        'member_id',
        'discount',
        'total',
        'service_type_id',
        'service_cost',
        'delivery_service',
        'delivery_charge',
    ];

    // Relationship dengan user (member)
    public function member()
    {
        return $this->belongsTo(User::class, 'member_id');
    }
    /**
     * Service type relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service_type(): BelongsTo
    {
        return $this->belongsTo(ServiceType::class);
    }
    public function items()
    {
        return $this->belongsToMany(Item::class, 'item_transactions', 'item_id','transaction_id')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }

    /**
     * Get formatted number of total
     *
     * @return string
     */
    public function getFormattedTotal(): string
    {
        return 'Rp ' . number_format($this->total, 0, ',', '.');
    }
}

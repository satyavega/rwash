<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\ExpenseCategory;
class Expense extends Model
{
    protected $dateFormat = 'Y-m-d';

    protected $fillable = ['date', 'category_id', 'total_amount', 'description'];

    public function category()
    {
        return $this->belongsTo(ExpenseCategory::class);
    }
}

<?php

namespace App\Models\Expense;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseNote extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the users for the ExpenseAttachment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the Expense for the ExpenseAttachment.
     */
    public function expense()
    {
        return $this->belongsTo(Expense::class);
    }
}

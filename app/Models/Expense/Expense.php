<?php

namespace App\Models\Expense;

use App\Models\Cash\Cash;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the users for the Expenseies.
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get the Cash for the Debtor.
     */
    public function cash()
    {
        return $this->belongsTo(Cash::class);
    }
    /**
     * Get the users for the ExpenseNote.
     */
    public function expense_notes()
    {
        return $this->hasMany(ExpenseNote::class);
    }
    /**
     * Get the users for the ExpenseImage.
     */
    public function expense_images()
    {
        return $this->hasMany(ExpenseImage::class);
    }
    /**
     * Get the users for the ExpenseAttachment.
     */
    public function expense_attachments()
    {
        return $this->hasMany(ExpenseAttachment::class);
    }
}

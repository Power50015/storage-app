<?php

namespace App\Models;

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
}

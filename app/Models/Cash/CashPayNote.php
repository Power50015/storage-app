<?php

namespace App\Models\Cash;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashPayNote extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    /**
     * Get the users for the DebtorAttachment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the Cash for the CashAttachment.
     */
    public function cash_pay()
    {
        return $this->belongsTo(CashPay::class);
    }
}

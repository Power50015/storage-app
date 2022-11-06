<?php

namespace App\Models\Debtor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class DebtorPayNote extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the users for the Debtor.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get the Debtor for the DebtorPayAttachment.
     */
    public function debtor_pay()
    {
        return $this->belongsTo(DebtorPay::class);
    }
}

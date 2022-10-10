<?php

namespace App\Models\Debtor;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DebtorPay extends Model
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
     * Get the DebtorPayAttachment for the Debtor.
     */
    public function debtor_pay_attachments()
    {
        return $this->hasMany(DebtorPayAttachment::class);
    }
}

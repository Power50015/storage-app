<?php

namespace App\Models\Cash;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashPay extends Model
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
     * Get the CashPayAttachment for the Cash.
     */
    public function cash_pay_attachments()
    {
        return $this->hasMany(CashPayAttachment::class);
    }
    /**
     * Get the CashPayImage for the Cash.
     */
    public function cash_pay_images()
    {
        return $this->hasMany(CashPayImage::class);
    }
    /**
     * Get the CashPayNote for the Cash.
     */
    public function cash_pay_notes()
    {
        return $this->hasMany(CashPayNote::class);
    }
}

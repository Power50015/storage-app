<?php

namespace App\Models\Debtor;

use App\Models\Cash\Cash;
use App\Models\People\People;
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

    /**
     * Get the DebtorPayNote for the Debtor.
     */
    public function debtor_pay_notes()
    {
        return $this->hasMany(DebtorPayNote::class);
    }

     /**
     * Get the DebtorPayImage for the Debtor.
     */
    public function debtor_pay_images()
    {
        return $this->hasMany(DebtorPayImage::class);
    }
    /**
     * Get the People for the DebtorPay.
     */
    public function people()
    {
        return $this->belongsTo(People::class);
    }

    /**
     * Get the Cash for the DebtorPay.
     */
    public function cash()
    {
        return $this->belongsTo(Cash::class);
    }
}

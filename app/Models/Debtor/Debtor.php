<?php

namespace App\Models\Debtor;

use App\Models\Cash\Cash;
use App\Models\People\People;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debtor extends Model
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
     * Get the DebtorAttachment for the Debtor.
     */
    public function debtor_attachments()
    {
        return $this->hasMany(DebtorAttachment::class);
    }
    /**
     * Get the DebtorImage for the Debtor.
     */
    public function debtor_images()
    {
        return $this->hasMany(DebtorImage::class);
    }
    /**
     * Get the DebtorNote for the Debtor.
     */
    public function debtor_notes()
    {
        return $this->hasMany(DebtorNote::class);
    }
    /**
     * Get the People for the IncomingInvoice.
     */
    public function people()
    {
        return $this->belongsTo(People::class);
    }
    /**
     * Get the Cash for the Debtor.
     */
    public function cash()
    {
        return $this->belongsTo(Cash::class);
    }
}

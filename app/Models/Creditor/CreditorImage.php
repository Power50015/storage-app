<?php

namespace App\Models\Creditor;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditorImage extends Model
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
     * Get the Creditor for the CreditorAttachment.
     */
    public function creditor()
    {
        return $this->belongsTo(Creditor::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Creditor extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the users for the Creditor.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user');
    }
    /**
     * Get the CreditorAttachment for the Creditor.
     */
    public function creditor_attachments()
    {
        return $this->hasMany(CreditorAttachment::class);
    }
}

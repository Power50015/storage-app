<?php

namespace App\Models\Creditor;

use App\Models\User;
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
        return $this->belongsTo(User::class);
    }
    /**
     * Get the CreditorAttachment for the Creditor.
     */
    public function creditor_attachments()
    {
        return $this->hasMany(CreditorAttachment::class);
    }
    /**
     * Get the CreditorImage for the Creditor.
     */
    public function creditor_images()
    {
        return $this->hasMany(CreditorImage::class);
    }
    /**
     * Get the CreditorImage for the Creditor.
     */
    public function creditor_notes()
    {
        return $this->hasMany(CreditorNote::class);
    }
}

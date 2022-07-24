<?php

namespace App\Models;

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
        return $this->belongsTo(User::class, 'user');
    }
    /**
     * Get the DebtorAttachment for the Debtor.
     */
    public function debtor_attachments()
    {
        return $this->hasMany(DebtorAttachment::class);
    }
}

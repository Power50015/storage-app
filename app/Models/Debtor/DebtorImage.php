<?php

namespace App\Models\Debtor;

use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DebtorImage extends Model
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
     * Get the Debtor for the DebtorAttachment.
     */
    public function debtor()
    {
        return $this->belongsTo(Debtor::class);
    }
}

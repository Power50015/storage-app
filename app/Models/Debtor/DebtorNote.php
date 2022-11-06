<?php

namespace App\Models\Debtor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class DebtorNote extends Model
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

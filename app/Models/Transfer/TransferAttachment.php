<?php

namespace App\Models\Transfer;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferAttachment extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    /**
     * Get the users for the TransferContent.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the users for the Transfer.
     */
    public function transfer()
    {
        return $this->belongsTo(Transfer::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $guarded = [];
    /**
     * Get the users for the Driver.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the Transfer for the Driver.
     */
    public function transfer()
    {
        return $this->hasMany(Transfer::class);
    }
}

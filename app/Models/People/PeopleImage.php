<?php

namespace App\Models\People;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeopleImage extends Model
{
    use HasFactory;
    protected $guarded = [];

     /**
     * Get the users for the people.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
     /**
     * Get the people for the people.
     */
    public function people()
    {
        return $this->belongsTo(People::class);
    }
}

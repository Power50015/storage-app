<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomingInvoice extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the users for the IncomingInvoice.
     */
    public function users()
    {
        return $this->belongsTo(User::class, 'user');
    }
    /**
     * Get the supplier for the IncomingInvoice.
     */
    public function supplier()
    {
        return $this->belongsTo(People::class, 'supplier');
    }
    /**
     * Get the cash for the IncomingInvoice.
     */
    public function cash_type()
    {
        return $this->belongsTo(Cash::class, 'cash_type');
    }

    /**
     * Get The Total Before Discount
    **/
    public function totalBeforeDiscount()
    {
        return 0;
    }
    /**
     * Get The Total After Discount
    **/
    public function totalAfterDiscount()
    {
        return 0;
    }
}

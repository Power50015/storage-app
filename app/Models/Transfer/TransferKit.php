<?php

namespace App\Models\Transfer;

use App\Models\Kit\Kit;
use App\Models\User;
use App\Models\Warehouse\Warehouse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferKit extends Model
{
    use HasFactory;
    protected $guarded = [];
     /**
     * Get the users for the IncomingInvoiceContent.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the outgoing invoice for the IncomingInvoiceContent.
     */
    public function transfer()
    {
        return $this->belongsTo(Transfer::class);
    }
    /**
     * Get the product for the IncomingInvoiceContent.
     */
    public function kit()
    {
        return $this->belongsTo(Kit::class);
    }

    /**
     * Get the warehouse_from for the Transfer.
     */
    public function warehouse_from()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_from_id');
    }
    /**
     * Get the warehouse_to for the Transfer.
     */
    public function warehouse_to()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_to_id');
    }
}

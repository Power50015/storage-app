<?php

namespace App\Models\Transfer;

use App\Models\Driver;
use App\Models\User;
use App\Models\Warehouse\Warehouse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;
    protected $guarded = [];
    /**
     * Get the users for the Transfer.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get the driver for the Transfer.
     */
    public function driver()
    {
        return $this->belongsTo(Driver::class);
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

    /**
     * Get the Transfer To for the Transfer Content.
     */
    public function transfer_contents()
    {
        return $this->hasMany(TransferContent::class);
    }

    /**
     * Get the Transfer To for the Transfer Attachment.
     */
    public function transfer_attachments()
    {
        return $this->hasMany(TransferAttachment::class);
    }

    /**
     * Get the Transfer To for the Transfer Kit.
     */
    public function transfer_kits()
    {
        return $this->hasMany(TransferKit::class);
    }
}

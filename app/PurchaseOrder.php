<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    public $incrementing = false;
    protected $primaryKey = 'ref';
    protected $keyType = 'string';
    protected $dates = [
        'date',
        'updated_at',
        'created_at'
    ];

    protected $casts = [
        'received' => 'boolean'
    ];

    public function purchase_items()
    {
        return $this->hasMany('App\PurchaseItem');
    }
}

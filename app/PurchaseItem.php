<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function purchase_order()
    {
        return $this->belongsTo('App\PurchaseOrder');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function sale_order()
    {
        return $this->belongsTo('App\SaleOrder');
    }
}

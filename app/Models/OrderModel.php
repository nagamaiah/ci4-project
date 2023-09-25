<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table            = 'orders';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['product_id', 'product_name', 'quantity', 'product_unit_price'];
}

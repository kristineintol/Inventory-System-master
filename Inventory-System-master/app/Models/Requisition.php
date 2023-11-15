<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'description', 'quantity', 'price', 'technician_id', 'status', 'user_id'];
}

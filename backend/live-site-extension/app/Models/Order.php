<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'service_id',
        'service_name',
        'amount',
        'currency',
        'customer_name',
        'customer_phone',
        'customer_email',
        'customer_company',
        'project_details',
        'payment_method',
        'payment_number',
        'transaction_id',
        'status',
    ];
}

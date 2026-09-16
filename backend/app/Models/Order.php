<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'service_id',
        'service_name',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_company',
        'payment_method',
        'payment_number',
        'transaction_id',
        'total_amount',
        'status',
        'project_details',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}

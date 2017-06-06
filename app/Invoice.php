<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Invoice extends Model
{
    // Set the connection to use MongoDB
    protected $connection = 'mongodb';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number', 'user', 'user_id', 'company_id', 'customer', 'customer_id', 'shipping_method',
        'products', 'date', 'delivery_date', 'due_date', 'payment_terms',
        'subtotal', 'tax', 'total',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function company()
    {
        return $this->belongsTo('App\Company');
    }
}

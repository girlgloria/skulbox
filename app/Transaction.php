<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'paid_to',
        'customer_name',
        'merchant_request_id',
        'checkout_request_id',
        'result_code',
        'reference',
        'phone_no',
        'description',
        'result_description',
        'mpesa_receipt_number',
        'amount',
        'transaction_date',
        'content_id'
    ];
}

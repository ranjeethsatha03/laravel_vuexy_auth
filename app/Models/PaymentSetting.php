<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentSetting extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'payment_settings';

    // Specify which attributes are mass assignable
    protected $fillable = [
        'nickname',
        'notes',
        'logo',
        'status',
        'type_of_payment',
        'payment_mode',
        'client_id',
        'client_secret_key',
    ];

    // Optionally, you can specify which attributes should be cast to native types
    protected $casts = [
        'status' => 'string',
        'type_of_payment' => 'string',
        'payment_mode' => 'string',
    ];
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentGatewaySettingsTable extends Migration
{
    public function up()
    {
        Schema::create('payment_settings', function (Blueprint $table) {
            $table->id();
            $table->string('nickname'); // Descriptive name for the payment gateway
            $table->text('notes')->nullable(); // Optional notes about the payment gateway
            $table->string('logo')->nullable(); // Optional logo path or URL for the payment gateway
            $table->enum('status', ['active', 'inactive']); // Status of the payment gateway
            $table->enum('type_of_payment', ['PayPal', 'Razorpay', 'Stripe', 'PhonePe', 'ICICI']); // Type of payment gateway
            $table->enum('payment_mode', ['test', 'live']); // Mode of operation for the payment gateway
            $table->string('client_id'); // Client ID for the payment gateway
            $table->string('client_secret_key'); // Client Secret Key for the payment gateway
            $table->timestamps(); // Timestamps for created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_settings');
    }
}

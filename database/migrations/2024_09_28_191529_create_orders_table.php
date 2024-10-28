<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('menu_id')->constrained();
            $table->foreignId('promo_id')->nullable()->constrained();
            $table->foreignId('user_id')->constrained();
            $table->integer('quantity');
            $table->decimal('total_price', 8, 2);
            $table->enum('pembayaran', ['QRIS', 'CASH']);
            $table->enum('status', ['Pesanan Sedang Dipersiapkan', 'Pesanan Siap'])->default('Pesanan Sedang Dipersiapkan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
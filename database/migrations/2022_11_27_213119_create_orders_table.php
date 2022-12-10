<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->uuid('uuid')->primary()->unique();
            $table->longText('sender')->nullable();
            $table->longText('consignee')->nullable();
            $table->string('sender_email')->nullable();
            $table->string('sender_mobile')->nullable();
            $table->string('consignee_mobile')->nullable();
            $table->string('consignee_email')->nullable();
            $table->string('sender_identify')->nullable();
            $table->string('consignee_identify')->nullable();
            $table->longText('sender_note')->nullable();
            $table->longText('consignee_note')->nullable();
            $table->timestamp('expexted_date_from')->nullable();
            $table->timestamp('expexted_date_to')->nullable();
            $table->boolean('canceld')->default(false);
            $table->bigInteger('region_id')->nullable();;
            $table->string('street_name')->nullable();;
            $table->string('district')->nullable();;
            $table->bigInteger('city_id')->nullable();;
            $table->string('building')->nullable();;
            $table->string('building_no')->nullable();;
            $table->tinyInteger('status')->default(0);
            $table->longText('description')->nullable();
            $table->longText('notes')->nullable();
            $table->double('sub_total')->default(0.0);
            $table->double('discount')->default(0.0);
            $table->double('extra')->default(0.0);
            $table->double('sum')->default(0.0);
            $table->double('vat')->default(0.0);
            $table->double('total')->default(0.0);
            $table->string('branch_id')->default(1);
            $table->string('user_id')->default(1);
            $table->string('village')->nullable();
            $table->string('pay')->nullable();
            $table->timestamp('receive_date')->nullable();
            $table->timestamp('shipping_date')->nullable();
            $table->timestamp('on_way_date')->nullable();

            $table->timestamp('order_date')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

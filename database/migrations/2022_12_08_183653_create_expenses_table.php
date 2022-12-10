<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('expense_title');
            $table->decimal('expense_cost')->default(0);
            $table->decimal('expense_vat')->default(0);
            $table->string('pay')->nullable();
            $table->string('expense_icon')->nullable();
            $table->timestamp('expense_date')->nullable();
            $table->bigInteger('user_id');
            $table->bigInteger('branch_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses');
    }
}

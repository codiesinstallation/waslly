<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->longText('name_ar');
            $table->longText('name_en')->nullable();
            $table->longText('location_ar')->nullable();
            $table->longText('location_en')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->decimal('vat')->default(0.0);
            $table->string('vat_num')->nullable();
            $table->longText('logo')->nullable();
            $table->uuid('uuid')->unique();
            $table->time('closure_hour')->default(now());
            $table->string('default_lang')->default('ar');

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branches');
    }
}

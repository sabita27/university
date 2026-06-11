<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('asset_type_id')->nullable();
            $table->unsignedBigInteger('asset_brand_id')->nullable();
            $table->string('serial_number')->nullable();
            $table->date('purchased_date')->nullable();
            $table->decimal('purchased_cost', 12, 2)->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('working_status')->default(1); // 1=Working, 0=Not Working
            $table->tinyInteger('availability_status')->default(1); // 1=Available, 0=Not Available
            $table->timestamps();

            $table->foreign('asset_type_id')->references('id')->on('asset_types')->onDelete('set null');
            $table->foreign('asset_brand_id')->references('id')->on('asset_brands')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('assets');
    }
};

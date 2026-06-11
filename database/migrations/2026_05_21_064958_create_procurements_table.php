<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procurements', function (Blueprint $table) {
            $table->id();
            $table->string('procurement_number')->unique();
            $table->string('name')->nullable();
            $table->string('email');
            $table->text('purpose')->nullable();
            $table->json('assets')->nullable();
            $table->date('request_date');
            $table->date('delivery_date');
            $table->tinyInteger('status')->default(1); // 1=Pending, 2=Approved, 0=Rejected
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
        Schema::dropIfExists('procurements');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('asset_types', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->tinyInteger('status')->default(1); // 1=Active, 0=Inactive
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('asset_types');
    }
};

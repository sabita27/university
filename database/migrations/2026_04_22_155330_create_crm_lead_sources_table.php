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
        Schema::create('crm_lead_sources', function (Blueprint $row) {
            $row->id();
            $row->string('title')->unique();
            $row->string('slug')->unique();
            $row->text('description')->nullable();
            $row->tinyInteger('status')->default(1)->comment('1: Action, 0: Inactive');
            $row->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crm_lead_sources');
    }
};

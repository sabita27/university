<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('procurements', function (Blueprint $table) {
            $table->unsignedBigInteger('staff_id')->nullable()->after('id')->comment('Reference to staff user');
            $table->foreign('staff_id')->references('id')->on('users')->onDelete('set null');
            $table->unsignedBigInteger('asset_id')->nullable()->after('staff_id')->comment('Reference to a primary asset');
            $table->foreign('asset_id')->references('id')->on('assets')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('procurements', function (Blueprint $table) {
            $table->dropForeign(['staff_id']);
            $table->dropForeign(['asset_id']);
            $table->dropColumn(['staff_id', 'asset_id']);
        });
    }
};

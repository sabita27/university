<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('procurements', function (Blueprint $table) {
            $table->string('urgency')->default('Immediate')->comment('Urgency level');
            $table->text('urgency_reason')->nullable()->comment('Reason if urgency is Other');
        });
    }

    public function down()
    {
        Schema::table('procurements', function (Blueprint $table) {
            $table->dropColumn(['urgency', 'urgency_reason']);
        });
    }
};

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
        Schema::table('crm_leads', function (Blueprint $table) {
            $table->renameColumn('assign_to', 'counsellor_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('crm_leads', function (Blueprint $table) {
            $table->renameColumn('counsellor_id', 'assign_to');
        });
    }
};

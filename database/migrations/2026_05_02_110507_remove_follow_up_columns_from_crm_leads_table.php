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
            $table->dropColumn(['follow_up_date', 'follow_up_note']);
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
            $table->date('follow_up_date')->nullable()->after('lead_status_id');
            $table->text('follow_up_note')->nullable()->after('follow_up_date');
        });
    }
};

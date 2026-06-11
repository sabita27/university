<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('procurements', function (Blueprint $table) {
            $table->dropColumn(['email', 'delivery_date']);
        });
    }

    public function down()
    {
        Schema::table('procurements', function (Blueprint $table) {
            $table->string('email');
            $table->date('delivery_date');
        });
    }
};

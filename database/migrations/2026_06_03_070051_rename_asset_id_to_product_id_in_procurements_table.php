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
        if (Schema::hasColumn('procurements', 'asset_id')) {
            Schema::table('procurements', function (Blueprint $table) {
                try {
                    $table->dropForeign(['asset_id']);
                } catch (\Exception $e) {
                    // Foreign key might already be dropped
                }
                $table->renameColumn('asset_id', 'product_id');
            });
        }

        Schema::table('procurements', function (Blueprint $table) {
            $table->unsignedInteger('product_id')->nullable()->change();
        });

        Schema::table('procurements', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('items')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('procurements', function (Blueprint $table) {
            try {
                $table->dropForeign(['product_id']);
            } catch (\Exception $e) {
                // Foreign key might not exist
            }
        });

        Schema::table('procurements', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->nullable()->change();
        });

        Schema::table('procurements', function (Blueprint $table) {
            $table->renameColumn('product_id', 'asset_id');
        });

        Schema::table('procurements', function (Blueprint $table) {
            $table->foreign('asset_id')->references('id')->on('assets')->onDelete('set null');
        });
    }
};

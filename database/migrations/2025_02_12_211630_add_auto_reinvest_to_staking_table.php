<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::table('stakings', function (Blueprint $table) {
            $table->boolean('auto_reinvest')->default(0)->after('transaction_id');
        });

        // Ensure existing NULL values are set to 0
        // DB::table('stakings')->whereNull('auto_reinvest')->update([
        //     'auto_reinvest' => 0,
        //     'updated_at' => DB::raw('updated_at') // Keeps the original value
        // ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stakings', function (Blueprint $table) {
            $table->dropColumn('auto_reinvest');
        });
    }
};

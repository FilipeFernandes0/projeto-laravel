<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterRemoveColumnsGameMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('game_matches', function (Blueprint $table) {
            // $table->dropColumn('attendance');
            // $table->dropColumn('stadium');
            // $table->dropColumn('goals');
            // $table->dropColumn('penalties');
            // $table->dropColumn('bookings');
          
            // $table->dropColumn('substitutions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('game_matches', function (Blueprint $table) {
            $table->integer('attendance');
            $table->string('stadium');
          
           
            $table->integer('goals');
            $table->integer('penalties');
            $table->integer('bookings');
            $table->integer('substitutions');
          
        
        });
    }
}

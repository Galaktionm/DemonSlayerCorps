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
        Schema::create('final_selection_results', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('demonSlayerId');
            $table->string('demonsKilled');
            $table->string('demonsKilledAlone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('final_selection_results');
    }
};

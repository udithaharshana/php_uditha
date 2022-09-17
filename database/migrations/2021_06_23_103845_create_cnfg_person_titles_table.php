<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCnfgPersonTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cnfg_person_titles', function (Blueprint $table) {
            $table->increments('tid')->comment('Title Id');
            $table->string('title',50)->comment('Title');
            $table->boolean('sts')->comment('Status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cnfg_person_titles');
    }
}

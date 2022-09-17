<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TitleAddToSupplier extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `suppliers` ADD `tid` TINYINT NOT NULL DEFAULT '2' COMMENT 'Title(1=Rev/2=Mr/3=Mrs/4=Miss/5=Ms)' AFTER `sid` ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('sid')->comment('Supplier Id');
            $table->string('name',500)->comment('Supplier Name');
            $table->text('address')->comment('Supplier Address');
            $table->string('email',100)->comment('Email')->nullable();
            $table->string('contcat_no',100)->comment('Contact No')->nullable();
            $table->text('rmk')->comment('Remark')->nullable();
            $table->boolean('sts')->comment('Status(1=Active/ 0=Inactive)')->default('1');
            $table->integer('create_user_id')->comment('Create User Id');
            $table->dateTime('create_date_time')->comment('Create Date Time');
            $table->integer('update_user_id')->comment('Update User Id')->nullable();
            $table->dateTime('update_date_time')->comment('Update Date Time')->nullable();
        });
        DB::statement("ALTER TABLE `suppliers` comment 'Supplier' ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
}

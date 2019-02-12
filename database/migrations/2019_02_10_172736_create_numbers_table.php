<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('numbers', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('number', 20, 0)->unique();
            $table->string('device_id', 20);
            $table->unsignedInteger('bought_by')->nullable();
            $table->timestamps();

            $table->foreign('bought_by')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');

            $table->index(['number']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('numbers');
    }
}

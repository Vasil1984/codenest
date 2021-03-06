<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('to_do_list_id')->unsigned()->index();
            $table->text('description');
            $table->integer('delete')->unsigned()->default(0);
            $table->enum('status', ['unread', 'readed'])->default('unread'); 
            $table->timestamps();
            $table->foreign('to_do_list_id')
                ->references('id')
                ->on('to_do_lists')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}

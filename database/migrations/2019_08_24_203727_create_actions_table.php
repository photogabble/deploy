<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateActionsTable extends Migration
{

    public function up()
    {
        Schema::create('actions', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('deployment_id');
            $table->unsignedBigInteger('task_id');
            $table->timestamps();

            $table->enum('status', ['waiting', 'in-progress', 'complete', 'error']);
            $table->string('message')->nullable();
            $table->text('log')->nullable();

            $table->foreign('task_id')
                ->references('id')->on('tasks');

            $table->foreign('deployment_id')
                ->references('id')->on('deployments')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('actions');
    }
}

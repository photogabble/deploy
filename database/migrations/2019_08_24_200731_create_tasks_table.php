<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateTasksTable
 *
 * Tasks are what are supposed to happen during a deployment, such as:
 * + Install composer dependencies
 * + Run npm ci
 * + Execute php artisan x
 * + Activate new release
 * + Purge old release
 *
 * Actions are a log of what happened when each Task was executed during
 * a certain Deployment.
 */
class CreateTasksTable extends Migration
{

    public function up()
    {
        Schema::create('tasks', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('project_id');
            $table->timestamps();

            $table->string('name');
            $table->text('script');
            $table->unsignedInteger('order');

            $table->foreign('project_id')
                ->references('id')->on('projects')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('tasks');
    }
}

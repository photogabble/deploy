<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateDeploymentsTable extends Migration
{

    public function up()
    {
        Schema::create('deployments', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('server_id');
            $table->timestamps();

            $table->foreign('project_id')
                ->references('id')->on('projects');

            $table->foreign('server_id')
                ->references('id')->on('servers')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('deployments');
    }
}

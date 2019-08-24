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

            // We deploy a project against an environment, eg production, staging, etc
            // maybe in the future we can allow PRs to have temp environments set up
            // so we can preview what a PR will look like... good for
            // static site generators.

            $table->unsignedBigInteger('environment_id');
            $table->unsignedBigInteger('project_id');

            $table->timestamps();

            $table->foreign('project_id')
                ->references('id')->on('projects');

            $table->foreign('environment_id')
                ->references('id')->on('environments')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('deployments');
    }
}

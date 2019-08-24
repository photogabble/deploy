<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateProjectTable extends Migration
{

    public function up()
    {
        Schema::create('projects', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->string('name');
            $table->enum('provider', ['github', 'gitlab']);
            $table->string('repository');
            $table->string('branch')->default('master');
            $table->string('heartbeat_url')->nullable();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('projects');
    }
}

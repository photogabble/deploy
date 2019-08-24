<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateServersTable extends Migration
{

    public function up()
    {
        Schema::create('servers', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('project_id');
            $table->timestamps();
            $table->timestamp('last_connected')->nullable();

            $table->string('name');
            $table->string('host');
            $table->string('username');
            $table->text('private_key'); // tmp
            $table->text('public_key');
            $table->text('project_path');

            $table->foreign('project_id')
                ->references('id')->on('projects')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('servers');
    }
}

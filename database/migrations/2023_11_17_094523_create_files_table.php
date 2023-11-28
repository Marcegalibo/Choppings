<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('fileable_id')->unsigned();//id del modelo (1)(34)
			$table->string('fileable_type');//modelo (product)(user)
			$table->string('route');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('files');
    }
};
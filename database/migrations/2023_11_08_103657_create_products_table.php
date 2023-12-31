<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('category_id')->unsigned();
            $table->integer('stock');
            $table->text('description_corta')->nullable();
            $table->text('description_larga')->nullable();
            $table->decimal('cost');
            $table->char('activo', 2);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')
            ->references('id')
            ->on('categories')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

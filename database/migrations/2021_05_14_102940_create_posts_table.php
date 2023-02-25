<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->unsignedBigInteger('source_url_id');
            $table->foreign('source_url_id')->references('id')->on('source_urls')->onDelete('cascade');
            $table->string('title');
            $table->text('text')->nullable();
            $table->string('img')->nullable();
            $table->string('biggerImg')->nullable();
            $table->text('url');
            $table->enum('status',['active','removed'])->default('active');
            $table->enum('position',['default','special','banner','advertising'])->default('default');
            $table->integer('visit')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
    }
;

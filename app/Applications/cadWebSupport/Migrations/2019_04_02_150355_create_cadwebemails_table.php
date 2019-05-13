<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCadwebemailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cadwebemails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->string('name')->nullable();
            $table->string('cc')->nullable();
            $table->string('subject')->nullable();
            $table->longText('bodyText')->nullable();
            $table->timestamp('emailDate')->nullable();
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
        Schema::dropIfExists('cadwebemails');
    }
}

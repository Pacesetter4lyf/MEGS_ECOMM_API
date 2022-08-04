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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->references('id')->on('users');
            $table->string("email_or_phone");
            $table->string("first_name");
            $table->string("last_name");
            $table->string("address");
            $table->string("apartment_address");
            $table->string("city");
            $table->string("country");
            $table->string("postal_code");
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
        Schema::dropIfExists('contacts');
    }
};

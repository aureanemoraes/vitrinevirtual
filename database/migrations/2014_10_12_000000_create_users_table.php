<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('cpf')->unique();
            $table->date('birthdate');
            $table->tinyInteger('is_admin')->default(0);
            $table->string('social_name')->nullable();
            $table->string('rg');
            $table->string('uf_rg');
            $table->integer('gender');
            $table->integer('ethnicity');
            $table->integer('civil_status');
            $table->integer('scholarity');
            $table->string('bussiness_name')->nullable();
            $table->longText('bussiness_description')->nullable();
            $table->string('image_path')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

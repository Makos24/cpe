<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('student_id');
            $table->string('name');
            $table->string('nickname')->nullable();
            $table->string('dob')->nullable();
            $table->integer('level')->nullable();
            $table->integer('state')->nullable();
            $table->integer('marital_status')->nullable();
            $table->text('address')->nullable();
            $table->string('image')->nullable();
            $table->string('phone')->nullable();
            $table->string('alt_phone')->nullable();
            $table->string('facebook_username')->nullable();
            $table->string('best_course')->nullable();
            $table->string('best_lecturer')->nullable();
            $table->string('worst_course')->nullable();
            $table->text('hobbies')->nullable();
            $table->text('likes_dislikes')->nullable();
            $table->text('worst_moment')->nullable();
            $table->text('best_moment')->nullable();
            $table->string('most_admired')->nullable();
            $table->string('role_model')->nullable();
            $table->string('future_aspiration')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SoftDeleteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('courses', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('roles', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('classes', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('list_registereds', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('times', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('semesters', function (Blueprint $table) {
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('courses', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('roles', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('classes', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('list_registereds', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('times', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('semesters', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}

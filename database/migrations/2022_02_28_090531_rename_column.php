<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('full_name','fullname');
        });
        Schema::table('list_registereds', function (Blueprint $table) {
            $table->renameColumn('class_id','course_id');
        });
        Schema::table('classes', function (Blueprint $table) {
            $table->renameColumn('class_name','name');
        });
        Schema::table('times', function (Blueprint $table) {
            $table->renameColumn('class_id','course_id');
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
            $table->renameColumn('fullname','full_name');
        });
        Schema::table('list_registereds', function (Blueprint $table) {
            $table->renameColumn('course_id','class_id');
        });
        Schema::table('classes', function (Blueprint $table) {
            $table->renameColumn('name','class_name');
        });
        Schema::table('times', function (Blueprint $table) {
            $table->renameColumn('course_id','class_id');
        });
    }
}

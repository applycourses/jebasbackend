<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('stu')->create('visas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('course_applied_id');
            $table->string('student_id');
            $table->string('visa_fees');
            $table->text('dependent');
            $table->string('processing_fees');
            $table->string('processed_by');
            $table->integer('medical_test_status');
            $table->string('medical_test_remarks');
            $table->string('police_clearance_status');
            $table->string('police_clearance_remarks');
            $table->integer('sop_status');
            $table->string('sop_remarks');
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
        Schema::dropIfExists('visas');
    }
}

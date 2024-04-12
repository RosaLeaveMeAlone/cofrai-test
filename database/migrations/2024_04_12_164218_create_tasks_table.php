<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('frequency');
            $table->unsignedInteger('repetitions')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->foreignId('task_group_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });

        DB::statement('ALTER TABLE tasks ADD CONSTRAINT check_task_dates CHECK ((repetitions IS NOT NULL AND start_date IS NULL AND end_date IS NULL) OR (repetitions IS NULL AND start_date IS NOT NULL AND end_date IS NOT NULL))');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE tasks DROP CONSTRAINT check_task_dates');

        Schema::dropIfExists('tasks');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('labels', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('label_task', function (Blueprint $table) {
            $table->foreignId('task_id')->constrained('tasks');
            $table->foreignId('label_id')->constrained('labels');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_labels');
        Schema::dropIfExists('labels');
    }
};

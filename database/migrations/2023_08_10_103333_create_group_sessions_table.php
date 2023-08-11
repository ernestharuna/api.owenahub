<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('group_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mentor_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('topic');
            $table->string('description');
            $table->string('meeting_link');
            $table->string('max_attendants')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_sessions');
    }
};

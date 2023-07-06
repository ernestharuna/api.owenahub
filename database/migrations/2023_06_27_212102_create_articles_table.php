c<?php

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
            Schema::create('articles', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->longText('content');
                $table->string('is_allowed')->default(false);
                $table->string('tags')->nullable();
                $table->foreignId('admin_id')->nullable()->constrained(table: 'admins', column: 'id')->onDelete('cascade');
                $table->foreignId('user_id')->nullable()->constrained(table: 'users', column: 'id')->onDelete('cascade');
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('articles');
        }
    };

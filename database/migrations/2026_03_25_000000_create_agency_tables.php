<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Menghapus tabel jika sudah ada (Mencegah error 'table already exists' karena duplikasi file migrasi)
        Schema::dropIfExists('project_requests');
        Schema::dropIfExists('messages');
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('projects');

        // 1. Tabel Projects (Proyek Klien)
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade');
            $table->string('name');
            $table->string('category'); // web, animation, uiux, sosmed
            $table->text('description')->nullable();
            $table->integer('progress')->default(0); // 0 - 100
            $table->timestamps();
        });

        // 2. Tabel Tasks (Tugas dari Admin ke Editor)
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->foreignId('editor_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->enum('priority', ['normal', 'high'])->default('normal');
            $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending');
            $table->date('due_date');
            $table->timestamps();
        });

        // 3. Tabel Messages (Sistem Chat/Comms Hub)
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade');
            $table->text('content');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });

        // 4. Tabel Project Requests (Request masuk dari Klien)
        Schema::create('project_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->string('category');
            $table->text('description');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_requests');
        Schema::dropIfExists('messages');
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('projects');
    }
};
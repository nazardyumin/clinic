<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('timezone');
            $table->rememberToken();
            $table->timestamps();
        });

        User::create([
            'name' => 'Назар',
            'email' => 'nazar@php.ru',
            'password' => bcrypt(123)
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

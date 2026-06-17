<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
 {
     Schema::table('users', function (Blueprint $table) {
         $table->integer('xp')->default(0);
         $table->integer('streak')->default(0);
         $table->date('last_played_at')->nullable(); 
     });
 }

 public function down(): void
 {
     Schema::table('users', function (Blueprint $table) {
         $table->dropColumn(['xp', 'streak', 'last_played_at']);
     });
 }
};

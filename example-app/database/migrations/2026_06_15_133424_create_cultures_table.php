<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cultures', function (Blueprint $table) {
            $table->string('id', 50)->primary(); // We forceren de lengte op 50
            $table->string('name');
            $table->string('emoji');
            $table->string('flag_path');
            $table->text('description');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cultures');
    }
};

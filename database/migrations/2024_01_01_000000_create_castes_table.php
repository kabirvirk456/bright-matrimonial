<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('castes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('religion_id')->nullable();
            $table->timestamps();

            $table->foreign('religion_id')->references('id')->on('religions')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('castes');
    }
};

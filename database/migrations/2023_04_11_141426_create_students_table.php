<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    //  U prva dva input fielda se dodaje Ime i Prezime učenika.
    //  U treci input field se dodaje url do slike Učenika
     //teacher - gradebook
     // gradebook - students
     // Vuces relaciju teacher -> gradebook -> students
     //Razredni staresina se dodeljuje tako sto se napravi gradebook i dodeli se dnevnik profesoru koji nema dnevnik

    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->longText('img_url');
            $table->foreignId('gradebook_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};

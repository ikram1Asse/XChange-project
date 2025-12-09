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
        Schema::create('annonces', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('photo');
            $table->decimal('prix', 8, 2);
            $table->string('description');
            $table->foreignId('categorie_id')
                ->constrained('categories')->onDelete('cascade');
            $table->date('datepublication')->default(now());
            $table->foreignId('expediteur')
                ->constrained('utilisateurs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annonces');
    }
};

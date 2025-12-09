<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Enhance annonces table
        Schema::table('annonces', function (Blueprint $table) {
            // Add new columns
            $table->enum('status', ['active', 'sold', 'inactive'])->default('active')->after('description');
            $table->enum('condition', ['new', 'like_new', 'good', 'fair', 'poor'])->after('status');
            $table->unsignedInteger('views')->default(0)->after('condition');
            $table->softDeletes(); // Add soft deletes

            // Drop the simple index we created before
            $table->dropIndex(['categorie_id']);

            // Add proper foreign key constraints with indexes
            $table->foreign('expediteur')
                ->references('id')
                ->on('utilisateurs')
                ->onDelete('cascade');

            // Add composite indexes for common queries
            $table->index(['categorie_id', 'status']); // For filtering by category and status
            $table->index(['created_at', 'status']); // For sorting by date and filtering by status
            $table->index(['prix', 'status']); // For price range queries
        });

        // Enhance messages table
        Schema::table('messages', function (Blueprint $table) {
            $table->boolean('is_read')->default(false)->after('contenu');
            $table->foreignId('annonce_id')->nullable()->after('contenu')
                ->constrained('annonces')
                ->onDelete('set null');
            $table->softDeletes();
        });

        // Enhance categories table
        Schema::table('categories', function (Blueprint $table) {
            $table->string('description')->nullable()->after('libelle');
            $table->string('icon')->nullable()->after('description');
            $table->softDeletes();
        });

        // Enhance utilisateurs table
        Schema::table('utilisateurs', function (Blueprint $table) {
            $table->string('telephone')->nullable()->after('email');
            $table->string('avatar')->nullable()->after('telephone');
            $table->boolean('is_active')->default(true)->after('avatar');
            $table->timestamp('last_login_at')->nullable()->after('is_active');
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        // Remove enhancements from annonces table
        Schema::table('annonces', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropColumn(['status', 'condition', 'views']);
            $table->dropIndex(['categorie_id', 'status']);
            $table->dropIndex(['created_at', 'status']);
            $table->dropIndex(['prix', 'status']);
            $table->index('categorie_id'); // Restore the simple index
        });

        // Remove enhancements from messages table
        Schema::table('messages', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropColumn(['is_read', 'annonce_id']);
        });

        // Remove enhancements from categories table
        Schema::table('categories', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropColumn(['description', 'icon']);
        });

        // Remove enhancements from utilisateurs table
        Schema::table('utilisateurs', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropColumn(['telephone', 'avatar', 'is_active', 'last_login_at']);
        });
    }
}; 
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
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('status', ['reported', 'in_progress', 'resolved', 'closed'])->default('reported');
            $table->foreignId('category_id')->constrained('incident_categories')->onDelete('restrict');
            $table->foreignId('reported_by')->constrained('users')->onDelete('restrict');
            $table->foreignId('assigned_to')->constrained('users')->onDelete('restrict')->nullable();
            $table->foreignId('city_id')->constrained('cities')->onDelete('restrict')->nullable();
            $table->geometry(column: 'location', subtype: 'POINT', srid: 4326);
            $table->timestamp('reported_at')->useCurrent();
            $table->timestamp('assigned_at')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidents');
    }
};

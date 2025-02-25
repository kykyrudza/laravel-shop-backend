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
        Schema::create('parameters', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('name');
            $table->string('code')
                ->unique();
            $table->string('description')
                ->nullable();
            $table->enum('type', [
                'string',
                'integer',
                'float',
                'boolean',
                'date',
            ]);
            $table->string('unit')
                ->nullable();
            $table->string('default_value')
                ->nullable();
            $table->boolean('is_required')
                ->default(false);
            $table->boolean('is_filterable')
                ->default(false);
            $table->boolean('is_visible')
                ->default(true);
            $table->integer('sort_order')
                ->default(0);
            $table->enum('status', [
                'active',
                'inactive',
            ])
                ->default('active');
            $table->json('name_translations')
                ->nullable();
            $table->json('description_translations')
                ->nullable();
            $table->decimal('min_value', 10, 2)
                ->nullable();
            $table->decimal('max_value', 10, 2)
                ->nullable();
            $table->json('validation_rules')
                ->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parameters');
    }
};

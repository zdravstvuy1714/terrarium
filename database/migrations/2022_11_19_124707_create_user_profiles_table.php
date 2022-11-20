<?php

use App\Enums\SexEnum;
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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->ulid('id')->primary();

            $table->foreignUlid('user_id')->constrained('users', 'id')->cascadeOnDelete();

            $table->string('first_name');
            $table->string('last_name');
            $table->date('birth_date');
            $table->enum('sex', SexEnum::values());

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};

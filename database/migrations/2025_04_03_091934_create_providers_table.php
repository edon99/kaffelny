<?php

use App\Enums\GenderEnum;
use App\Enums\OccupationEnum;
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
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('birthdate');
            $table->enum('gender', GenderEnum::values())->nullable();
            $table->enum('occupation', OccupationEnum::values())->nullable();
            $table->string('email')->unique();
            $table->string('phone')->index();
            $table->decimal('pay_per_hour', 8, 2)->nullable();
            $table->string('profile_image')->nullable();
            $table->string('id_card')->nullable();
            $table->string('verification_certificate')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->decimal('long', 10, 7)->nullable();
            $table->decimal('lat', 10, 7)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('providers');
    }
};

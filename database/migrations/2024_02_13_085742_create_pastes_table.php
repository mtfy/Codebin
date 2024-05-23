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
        Schema::create('pastes', function (Blueprint $table) {
			$table->charset = 'utf8mb4';
			$table->collation = 'utf8mb4_general_ci';
            $table->id();
			$table->string('token', 10)->unique()->collation('latin1_general_cs');
			$table->string('title', 70)->nullable()->default(NULL)->collaction('utf8mb4_general_ci')->index('title');
			$table->mediumText('content')->collaction('utf8mb4_general_ci')->index('content');
			$table->unsignedTinyInteger('syntax')->default(0);
			$table->unsignedInteger('privacy')->default(0);
			$table->string('password', '72')->nullable()->default(NULL)->collation('latin1_general_ci');
			$table->string('creation_ip', 50)->collaction('latin1_general_ci');
			$table->dateTimeTz('expire')->nullable()->default(NULL);
			$table->unsignedInteger('user')->nullable()->default(NULL)->index('user');
            $table->timestampsTz();
			$table->softDeletesTz();
			$table->fullText('token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
		Schema::table('pastes', function(Blueprint $table) {
			$table->dropSoftDeletesTz();
		});
        Schema::dropIfExists('pastes');
    }
};

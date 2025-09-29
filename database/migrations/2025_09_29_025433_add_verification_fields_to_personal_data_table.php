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
        Schema::table('personal_data', function (Blueprint $table) {
            $table->boolean('is_verified')->default(false)->after('no_kk');
            $table->text('verification_notes')->nullable()->after('is_verified');
            $table->foreignId('verified_by')->nullable()->constrained('users')->after('verification_notes');
            $table->timestamp('verified_at')->nullable()->after('verified_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('personal_data', function (Blueprint $table) {
            $table->dropForeign(['verified_by']);
            $table->dropColumn(['is_verified', 'verification_notes', 'verified_by', 'verified_at']);
        });
    }
};

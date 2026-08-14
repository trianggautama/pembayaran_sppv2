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
        Schema::table('pembayarans', function (Blueprint $table) {
            $table->text('alasan_ditolak')->nullable()->after('catatan');
            $table->foreignId('verified_by')->nullable()->constrained('users')->after('alasan_ditolak');
            $table->timestamp('verified_at')->nullable()->after('verified_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembayarans', function (Blueprint $table) {
            $table->dropForeign(['verified_by']);
            $table->dropColumn(['alasan_ditolak', 'verified_by', 'verified_at']);
        });
    }
};

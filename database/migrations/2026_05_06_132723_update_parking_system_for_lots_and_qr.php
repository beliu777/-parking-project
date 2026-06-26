<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('parking_spots', function (Blueprint $table) {
            if (!Schema::hasColumn('parking_spots', 'parking_lot_id')) {
                $table->foreignId('parking_lot_id')->nullable()->constrained('parking_lots')->nullOnDelete();
            }
        });

        Schema::table('bookings', function (Blueprint $table) {
            if (!Schema::hasColumn('bookings', 'phone')) {
                $table->string('phone')->nullable();
            }

            if (!Schema::hasColumn('bookings', 'duration_minutes')) {
                $table->integer('duration_minutes')->default(15);
            }

            if (!Schema::hasColumn('bookings', 'qr_code')) {
                $table->string('qr_code')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            if (Schema::hasColumn('bookings', 'phone')) {
                $table->dropColumn('phone');
            }

            if (Schema::hasColumn('bookings', 'duration_minutes')) {
                $table->dropColumn('duration_minutes');
            }

            if (Schema::hasColumn('bookings', 'qr_code')) {
                $table->dropColumn('qr_code');
            }
        });

        Schema::table('parking_spots', function (Blueprint $table) {
            if (Schema::hasColumn('parking_spots', 'parking_lot_id')) {
                $table->dropConstrainedForeignId('parking_lot_id');
            }
        });
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("UPDATE users SET balance = 0 WHERE balance = 5000");
    }

    public function down(): void
    {
        DB::statement("UPDATE users SET balance = 5000 WHERE balance = 0");
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            if (!Schema::hasColumn('orders', 'receiver_name')) {

                $table->string('receiver_name')
                    ->nullable()
                    ->after('user_id');

            }

            if (!Schema::hasColumn('orders', 'phone')) {

                $table->string('phone')
                    ->nullable()
                    ->after('receiver_name');

            }

            if (!Schema::hasColumn('orders', 'shipping_address')) {

                $table->text('shipping_address')
                    ->nullable()
                    ->after('phone');

            }

            if (!Schema::hasColumn('orders', 'status')) {

                $table->enum('status', [
                    'menunggu',
                    'diproses',
                    'dikirim',
                    'selesai'
                ])->default('menunggu')
                  ->after('shipping_address');

            }

        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            $columns = [];

            if (Schema::hasColumn('orders', 'receiver_name')) {
                $columns[] = 'receiver_name';
            }

            if (Schema::hasColumn('orders', 'phone')) {
                $columns[] = 'phone';
            }

            if (Schema::hasColumn('orders', 'shipping_address')) {
                $columns[] = 'shipping_address';
            }

            if (Schema::hasColumn('orders', 'status')) {
                $columns[] = 'status';
            }

            if (!empty($columns)) {
                $table->dropColumn($columns);
            }

        });
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitleIndexToPostsTable extends Migration
{
    private static string $column = 'title';

    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->unique([static::$column]);
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropUnique([static::$column]);
        });
    }
}

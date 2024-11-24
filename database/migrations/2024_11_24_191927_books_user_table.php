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
        //Add a table to store the books that a user has read
        Schema::create('user_books', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
            $table->text('book_isbn')->unsigned();
            $table->timestamps();
            $table->primary(['user_id', 'book_isbn']);
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

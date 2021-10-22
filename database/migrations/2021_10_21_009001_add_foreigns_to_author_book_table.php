<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToAuthorBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('author_book', function (Blueprint $table) {
            $table
                ->foreign('book_id')
                ->references('id')
                ->on('books')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('author_id')
                ->references('id')
                ->on('authors')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('author_book', function (Blueprint $table) {
            $table->dropForeign(['book_id']);
            $table->dropForeign(['author_id']);
        });
    }
}

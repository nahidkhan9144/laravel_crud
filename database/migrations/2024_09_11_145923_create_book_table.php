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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title'); 
            $table->string('author');
            $table->string('description');
            $table->date('published_date'); 
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            // $table->dropColumn('published_date');
        });
    }

    
};

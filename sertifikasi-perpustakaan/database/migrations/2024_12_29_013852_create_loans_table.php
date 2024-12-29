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
        Schema::create('loans', function (Blueprint $table) {
            $table->id(); // LoanID
            $table->unsignedBigInteger('member_id'); // Foreign key untuk member
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade'); // Relasi ke Members
            $table->foreignId('book_id')->constrained()->onDelete('cascade'); // Relasi ke Books
            $table->date('loan_date');
            $table->date('due_date');
            $table->timestamps();
        });
    }    
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};

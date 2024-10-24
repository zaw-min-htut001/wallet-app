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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('ref_no');
            $table->string('transcation_id')->unique();
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('type')->comment('1 => income , 2 => expense');
            $table->decimal('amount', 20, 2);
            $table->unsignedBigInteger('source_id');
            $table->string('note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

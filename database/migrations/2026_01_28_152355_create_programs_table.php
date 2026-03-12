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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->date('date');
            $table->time('time');
            $table->decimal('financial_amount', 10, 2)->nullable();
            $table->string('program_incharge')->nullable();
            $table->string('program_incharge_phone')->nullable();
            $table->enum('vip_present', ['yes','no'])->default('no');
            $table->string('vip_name')->nullable();
            $table->string('nature_of_admission')->nullable();
            $table->boolean('is_deleted')->default(0);
            $table->string('village')->nullable();
            $table->string('mandal')->nullable();
            $table->string('district');
            $table->string('pincode', 10)->nullable();
            $table->integer('number_of_participants')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};

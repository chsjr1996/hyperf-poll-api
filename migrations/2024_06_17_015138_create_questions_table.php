<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->uuid('id')->unique()->index();
            $table->uuid('author_id');
            $table->string('title');
            $table->string('description')->nullable();
            $table->enum('status', ['open', 'close'])->index();
            $table->timestamp('close_at')->nullable();
            $table->datetimes();
            $table->softDeletes();

            // relationships
            $table->foreign('author_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
}

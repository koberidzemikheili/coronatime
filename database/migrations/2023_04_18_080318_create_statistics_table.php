<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('statistics', function (Blueprint $table) {
			$table->id();
			$table->string('country_code');
			$table->json('country_name');
			$table->integer('confirmed');
			$table->integer('recovered');
			$table->integer('deaths');
			$table->integer('critical');
			$table->timestamp('created_at');
			$table->timestamp('updated_at');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('statistics');
	}
};

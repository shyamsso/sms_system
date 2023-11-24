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
    Schema::table('client_number', function (Blueprint $table) {
      $table->string('apiId');
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('client_number', function (Blueprint $table) {
      $table->dropColumn('apiId');
      $table->dropColumn('deleted_at');
    });
  }
};

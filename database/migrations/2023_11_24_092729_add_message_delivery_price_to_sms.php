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
    Schema::table('sms', function (Blueprint $table) {
      $table->string('message_amount');
      $table->string('message_comision_amount');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('sms', function (Blueprint $table) {
      $table->dropColumn('delivery_status');
      $table->dropColumn('message_comision_amount');
    });
  }
};

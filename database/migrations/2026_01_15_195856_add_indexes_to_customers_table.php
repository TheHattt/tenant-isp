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
        Schema::table("customers", function (Blueprint $table) {
            // Adding indexes for faster searching on these specific columns
            $table->index("tenant_id");
            $table->index("email");
            $table->index("phone");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("customers", function (Blueprint $table) {
            // Drop the indexes if we rollback the migration
            // Syntax: dropIndex(['column_name'])
            $table->dropIndex(["tenant_id"]);
            $table->dropIndex(["email"]);
            $table->dropIndex(["phone"]);
        });
    }
};

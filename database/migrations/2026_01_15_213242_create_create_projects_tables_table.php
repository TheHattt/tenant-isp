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
        Schema::create("projects", function (Blueprint $table) {
            $table->id();
            $table->foreignId("tenant_id")->constrained()->cascadeOnDelete();
            $table->foreignId("customer_id")->constrained()->cascadeOnDelete();
            $table->string("name");
            $table->string("description")->nullable();
            $table
                ->string("status", [
                    "Planning",
                    "In Progress",
                    "Completed",
                    "Cancelled",
                    "On Hold",
                ])
                ->default("Planning");
            $table->string("priority");
            $table->date("start_date")->after("priority")->nullable();
            $table->date("end_date")->after("start_date")->nullable();
            $table->decimal("budget", 10, 2)->default(0.0);
            $table->string("assigned_to");
            $table->string("created_by");
            $table->string("updated_by");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("projects");
    }
};

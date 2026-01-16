<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ProjectController;

Route::get("/", function () {
    return view("welcome");
});

Route::get("/dashboard", function () {
    return view("dashboard");
})
    ->middleware(["auth", "verified"])
    ->name("dashboard");

Route::middleware("auth")->group(function () {
    // Profile Routes
    Route::get("/profile", [ProfileController::class, "edit"])->name(
        "profile.edit",
    );
    Route::patch("/profile", [ProfileController::class, "update"])->name(
        "profile.update",
    );
    Route::delete("/profile", [ProfileController::class, "destroy"])->name(
        "profile.destroy",
    );

    // Project Resource
    Route::resource("projects", ProjectController::class);

    // Customer Resource
    Route::resource("customers", CustomerController::class);

    // --- FIX FOR NOTES ---
    // This defines the specific nested route your Blade file is calling
    Route::post("/customers/{customer}/notes", [
        NoteController::class,
        "store",
    ])->name("customers.notes.store");

    // Keep this if you want to allow direct deletion of notes by ID
    Route::delete("/notes/{note}", [NoteController::class, "destroy"])->name(
        "notes.destroy",
    );
});

Route::middleware("auth")->group(function () {
    // Document Resource
    Route::resource("customers.documents", DocumentController::class);
});

require __DIR__ . "/auth.php";

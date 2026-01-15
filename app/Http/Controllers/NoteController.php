<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Customer;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Store a newly created note in storage.
     */
    public function store(Request $request, Customer $customer)
    {
        // 1. Validate the input
        $validated = $request->validate([
            "body" => "required|string|max:1000",
        ]);

        // 2. Create the note linked to the customer
        $customer->notes()->create([
            "body" => $validated["body"],
        ]);

        // 3. Redirect back with success message
        return back()->with("success", "Note added successfully!");
    }

    /**
     * Remove the specified note from storage.
     */
    public function destroy(Note $note)
    {
        // Optional: Add a check to ensure the user is authorized to delete
        $note->delete();

        return back()->with("success", "Note removed.");
    }
}

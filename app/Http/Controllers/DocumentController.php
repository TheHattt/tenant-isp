<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function store(Request $request, Customer $customer)
    {
        $request->validate([
            "document" => "required|file|max:10240", // 10MB limit
        ]);

        if ($request->hasFile("document")) {
            $file = $request->file("document");

            // 2. Store the file
            $path = $file->store("customer_docs", "public");

            // 3. Create the DB record with correct column names
            $customer->documents()->create([
                "original_name" => $file->getClientOriginalName(), // Use $file here
                "file_path" => $path, // Corrected from 'path'
                "file_type" => $file->getClientMimeType(),
            ]);

            return redirect()
                ->route("customers.show", $customer)
                ->with("success", "Document uploaded successfully.");
        }

        return back()->with("error", "No file was selected.");
    }
}

<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function store(Request $request, Customer $customer)
    {
        $request->validate([
            "name" => "required|string|max:255",
            "description" => "required|string|max:255",
        ]);

        $file = $request->file("document");
        $path = $file->store("documents_docs", ["disk" => "public"]);

        $document = $customer->documents()->create([
            "original_name" => $request->getClientOriginalName(),
            "path" => $path,
            "file_type" => $file->getClientMimeType(),
        ]);

        return redirect()
            ->route("customers.show", $customer)
            ->with("success", "Document uploaded successfully.");
    }
}

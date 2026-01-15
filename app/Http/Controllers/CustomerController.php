<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Traits\HasSearchableTable;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    use HasSearchableTable;

    public function __construct()
    {
        $this->authorizeResource(Customer::class, "customer");
    }

    public function index()
    {
        $customers = $this->buildTableQuery(Customer::class, [
            "name",
            "email",
            "phone",
        ]);

        return view("components.customers.index", compact("customers"));
    }

    public function create()
    {
        return view("components.customers.create");
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|string|max:80",
            "phone" => "required|numeric",
            "email" => [
                "required",
                "email",
                "max:80",
                Rule::unique("customers")->where(
                    fn($q) => $q->where("tenant_id", auth()->user()->tenant_id),
                ),
            ],
        ]);

        Customer::create(
            array_merge($validated, [
                "tenant_id" => auth()->user()->tenant_id,
            ]),
        );

        return redirect()
            ->route("customers.index")
            ->with("success", "Customer created.");
    }

    public function show(Customer $customer)
    {
        return view("components.customers.show", compact("customer"));
    }

    public function edit(Customer $customer)
    {
        return view("components.customers.edit", compact("customer"));
    }
    public function update(Request $request, Customer $customer)
    {
        $data = $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|email|unique:customers,email," . $customer->id,
            "phone" => "nullable|string",
            "avatar" => "nullable|image|mimes:jpg,jpeg,png|max:2048",
        ]);

        if ($request->hasFile("avatar")) {
            // 1. Delete old one
            if ($customer->avatar) {
                \Storage::disk("public")->delete($customer->avatar);
            }

            // 2. Store new one and UPDATE the data array
            $path = $request->file("avatar")->store("avatars", "public");
            $data["avatar"] = $path; // This line is critical!
        }

        // 3. Perform the update
        $customer->update($data);

        // 4. Force a clean redirect to prevent "double-click" syndrome
        return redirect()
            ->route("customers.index", $customer)
            ->with("success", "Updated!");
    }
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()
            ->route("customers.index")
            ->with("success", "Customer deleted.");
    }
}

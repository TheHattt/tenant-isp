<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Customer::class, "customer");
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $customers = Customer::where("tenant_id", $user->tenant_id)
            ->latest()
            ->paginate(10);
        return view("components.customers.index", compact("customers"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("components.customers.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        // validate data from the request
        $validated = $request->validate([
            "name" => "required|string|max:80",
            "email" => "required|email|nullable|max:80|",
            Rule::unique("customers")->where(function ($query) use ($user) {
                return $query->where("tenant_id", $user->tenant_id);
            }),
            "phone" => "required|numeric",
        ]);

        Customer::create([
            ...$validated,
            "tenant_id" => $request->user()->tenant_id,
        ]);

        return redirect()->route("customers.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return view("components.customers.show", compact("customer"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view("components.customers.edit", compact("customer"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $user = Auth::user();
        // validate data from the request
        $validated = $request->validate([
            "name" => "required|string|max:80",
            "email" => "required|email|nullable|max:80|",
            Rule::unique("customers")->where(function ($query) use ($user) {
                return $query->where("tenant_id", $user->tenant_id);
            }),
            "phone" => "required|numeric",
        ]);

        $customer->update($validated);

        return redirect()->route("customers.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route("customers.index");
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Customer;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with("customer")->latest()->paginate(10);
        return view("components.projects.index", compact("projects"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::orderBy("name")->get();
        return view("components.projects.create", compact("customers"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "customer_id" => "required|exists:customers,id",
            "name" => "required|string|max:80",
            "description" => "nullable|string",
            "status" => "required|string|max:50",
            "priority" => "required|string|max:50",
            "budget" => "required|numeric",
        ]);

        $project = Project::create($validatedData);

        return redirect()
            ->route("projects.index")
            ->with("success", "Project created successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view("components.projects.show", compact("project"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $customers = Customer::orderBy("name")->get();
        return view(
            "components.projects.edit",
            compact("project", "customers"),
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            "customer_id" => "required|exists:customers,id",
            "name" => "required|string|max:80",
            "description" => "nullable|string",
            "status" => "required|string|max:50",
            "priority" => "required|string|max:50",
            "budget" => "required|numeric",
        ]);

        $project->update($validatedData);

        return redirect()
            ->route("projects.index")
            ->with("success", "Project updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()
            ->route("projects.index")
            ->with("success", "Project deleted successfully.");
    }
}

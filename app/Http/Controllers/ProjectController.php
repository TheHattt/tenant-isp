<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::where("tenant_id", Auth::user()->tenant_id);

        // Get counts before pagination
        $totalCount = $query->count();
        $inProgressCount = (clone $query)
            ->where("status", "in_progress")
            ->count();
        $highPriorityCount = (clone $query)->where("priority", "high")->count();

        $projects = $query
            ->with("customer")
            ->when($request->input("filter.search"), function (
                $query,
                $search,
            ) {
                $query
                    ->where("name", "like", "%{$search}%")
                    ->orWhereHas("customer", function ($q) use ($search) {
                        $q->where("name", "like", "%{$search}%");
                    });
            })
            ->latest()
            ->paginate(6)
            ->withQueryString();

        return view(
            "components.projects.index",
            compact(
                "projects",
                "totalCount",
                "inProgressCount",
                "highPriorityCount",
            ),
        );
    }

    public function show(Project $project)
    {
        // $this->authorize("view", $project);

        return view("components.projects.show", compact("project"));
    }

    public function create()
    {
        $customers = Customer::where("tenant_id", Auth::user()->tenant_id)
            ->orderBy("name")
            ->get();

        $project = new Project();

        return view(
            "components.projects.create",
            compact("customers", "project"),
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "customer_id" => "required|exists:customers,id",
            "name" => "required|string|max:80",
            "description" => "nullable|string",
            "priority" => "required|string",
            "status" =>
                "required|in:planning,in_progress,completed,on_hold,cancelled",
            "budget" => "nullable|numeric",
            "start_date" => "required|date",
            "end_date" => "required|date|after_or_equal:start_date",
        ]);

        Project::create(
            array_merge($validated, [
                "tenant_id" => auth()->user()->tenant_id,
                "created_by" => auth()->id(),
                "updated_by" => auth()->id(),
                "assigned_to" => auth()->id(), // Temporary placeholder until you add user selection
            ]),
        );

        return redirect()
            ->route("projects.index")
            ->with("success", "Project created successfully!");
    }

    public function edit(Project $project)
    {
        if ($project->tenant_id !== Auth::user()->tenant_id) {
            abort(403);
        }

        $customers = Customer::where("tenant_id", Auth::user()->tenant_id)
            ->orderBy("name")
            ->get();

        return view(
            "components.projects.edit",
            compact("project", "customers"),
        );
    }

    public function update(Request $request, Project $project)
    {
        // 1. Security Check
        if ($project->tenant_id !== Auth::user()->tenant_id) {
            abort(403);
        }

        // 2. Validation
        $validatedData = $request->validate([
            "customer_id" => "required|exists:customers,id",
            "name" => "required|string|max:80",
            "description" => "nullable|string",
            "status" =>
                "required|in:planning,in_progress,completed,on_hold,cancelled",
            "priority" => "required|string",
            "budget" => "nullable|numeric",
            "start_date" => "required|date",
            "end_date" => "required|date|after_or_equal:start_date",
        ]);

        // 3. Update execution
        $project->update(
            array_merge($validatedData, [
                "updated_by" => auth()->id(),
            ]),
        );

        // 4. Redirect
        return redirect()
            ->route("projects.index")
            ->with("success", "Project updated successfully.");
    }

    public function destroy(Project $project)
    {
        if ($project->tenant_id !== Auth::user()->tenant_id) {
            abort(403);
        }
        $project->delete();
        return redirect()
            ->route("projects.index")
            ->with("success", "Project purged.");
    }
}

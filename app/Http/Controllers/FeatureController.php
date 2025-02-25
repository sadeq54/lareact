<?php

namespace App\Http\Controllers;

use App\Http\Resources\FeatureResource;
use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paginated = Feature::latest()->paginate();

        return Inertia::render('Features/Index', [
            'features' => FeatureResource::collection($paginated),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Features/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

      
        $data = $request->validate([
            'name' => ['required' , 'string'],
            'description' => ['nullable','string'],
        ]);
        
        $data['user_id'] = Auth::user()->id;


         Feature::create($data);


         return redirect()->route('feature.index')->with('success', 'Feature created successfully.');    }
   
    /**
     * Display the specified resource.
     */
    public function show(Feature $feature)
    {
        return Inertia::render('Features/Show', [
            'feature' => new FeatureResource($feature),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feature $feature)
    {
        return Inertia::render('Features/Edit', [
            'feature' => new FeatureResource($feature),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feature $feature)
    {
        $data = $request->validate([
            'name' => ['required' , 'string'],
            'description' => ['nullable','string'],
        ]);

        $feature->update($data);

        return redirect()->route('feature.index')->with('success', 'Feature updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feature $feature)
    {
        $feature->delete();
        return to_route('feature.index')->with('success', 'Feature deleted successfully');
        

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Meal::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:meals',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric'
        ]);

        $meal = Meal::query()->create($validated);
        return response()->json(['message' => 'Meal created successfully', 'meal' => $meal], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $meal = Meal::query()->findOrFail($id);
            return response()->json($meal);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Meal not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $meal = Meal::query()->findOrFail($id);

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'category' => 'required|string|max:255',
                'price' => 'required|numeric'
            ]);

            $meal->update($validated);

            return response()->json(['message' => 'Meal updated successfully', 'meal' => $meal]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Meal not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $meal = Meal::query()->findOrFail($id);
            $meal->delete();

            return response()->json(['message' => 'Meal deleted successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Meal not found'], 404);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class MealController extends Controller
{
    /**
     * Display all meals from the database.
     */
    public function index()
    {
        $meals = Meal::all();
        $meals = collect($meals)->sortBy('name')->values()->toArray();
        return response()->json($meals);
    }

    /**
     * Store a newly created meal in the database.
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
     * Display the specified meal.
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
     * Update the specified meal in the database.
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
     * Remove the specified meal from the database.
     */
    public function destroy(string $id)
    {
        try {
            $meal = Meal::query()->with('menus')->findOrFail($id);

            if (!$meal) {
                return response()->json(['message' => 'Meal not found'], 404);
            }

            if ($meal->menus->count() > 0) {
                return response()->json(['message' => 'Cannot delete meal because it is in a menu'], 400);
            }

            $meal->delete();
            return response()->json(['message' => 'Meal deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}

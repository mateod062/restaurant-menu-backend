<?php

namespace App\Http\Controllers;

use App\Models\DailyMenu;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class DailyMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dailyMenus = DailyMenu::with('menus')->get();
        return response()->json($dailyMenus);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date|unique:daily_menus'
        ]);

        $dailyMenu = DailyMenu::query()->create($validated);
        return response()->json(['message' => 'Daily menu created successfully', 'daily_menu' => $dailyMenu], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $dailyMenu = DailyMenu::with('menus')->findOrFail($id);
            return response()->json($dailyMenu);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Daily menu not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $dailyMenu = DailyMenu::query()->findOrFail($id);

            $validated = $request->validate([
                'date' => 'required|date|unique:daily_menus'
            ]);

            $dailyMenu->update($validated);
            return response()->json(['message' => 'Daily menu updated successfully', 'daily_menu' => $dailyMenu], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Daily menu not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $dailyMenu = DailyMenu::query()->findOrFail($id);
            $dailyMenu->delete();
            return response()->json(['message' => 'Daily menu deleted successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Daily menu not found'], 404);
        }
    }
}

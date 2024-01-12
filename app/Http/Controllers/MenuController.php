<?php

namespace App\Http\Controllers;

use App\Models\DailyMenu;
use App\Models\Meal;
use App\Models\Menu;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::with('meals')->get();
        return response()->json($menus);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'soup' => 'required|exists:meals,name',
                'main_meal' => 'required|exists:meals,name',
                'side_dish' => 'required|exists:meals,name',
                'dessert' => 'required|exists:meals,name',
                'daily_menu_date' => 'required|exists:daily_menus,date'
            ]);

            $menu = Menu::query()->create();

            $soupId = Meal::where('name', $validated['soup'])->firstOrFail()->id;
            $mainMealId = Meal::where('name', $validated['main_meal'])->firstOrFail()->id;
            $sideDishId = Meal::where('name', $validated['side_dish'])->firstOrFail()->id;
            $dessertId = Meal::where('name', $validated['dessert'])->firstOrFail()->id;
            $dailyMenuId = DailyMenu::where('date', $validated['daily_menu_date'])->firstOrFail()->id;

            $menu->soups()->attach($soupId);
            $menu->mainMeals()->attach($mainMealId);
            $menu->sideDishes()->attach($sideDishId);
            $menu->desserts()->attach($dessertId);
            $menu->dailyMenu()->associate($dailyMenuId);

            return response()->json(['message' => 'Menu created successfully', 'menu' => $menu], 201);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Menu not found'], 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $menu = Menu::with('meals')->findOrFail($id);
            return response()->json($menu);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Menu not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $menu = Menu::query()->findOrFail($id);

            $validated = $request->validate([
                'soup' => 'required|exists:meals,name',
                'main_meal' => 'required|exists:meals,name',
                'side_dish' => 'required|exists:meals,name',
                'dessert' => 'required|exists:meals,name',
                'daily_menu_date' => 'required|exists:daily_menus,date'
            ]);

            $soupId = Meal::where('name', $validated['soup'])->firstOrFail()->id;
            $mainMealId = Meal::where('name', $validated['main_meal'])->firstOrFail()->id;
            $sideDishId = Meal::where('name', $validated['side_dish'])->firstOrFail()->id;
            $dessertId = Meal::where('name', $validated['dessert'])->firstOrFail()->id;
            $dailyMenuId = DailyMenu::where('date', $validated['daily_menu_date'])->firstOrFail()->id;

            $menu->soups()->attach($soupId);
            $menu->mainMeals()->attach($mainMealId);
            $menu->sideDishes()->attach($sideDishId);
            $menu->desserts()->attach($dessertId);
            $menu->dailyMenu()->associate($dailyMenuId);

            return response()->json(['message' => 'Menu updated successfully', 'menu' => $menu]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Menu not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $menu = Menu::query()->findOrFail($id);

            $menu->soups()->detach();
            $menu->mainMeals()->detach();
            $menu->sideDishes()->detach();
            $menu->desserts()->detach();
            $menu->dailyMenu()->dissociate();

            $menu->delete();

            return response()->json(['message' => 'Menu deleted successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Menu not found'], 404);
        }
    }
}

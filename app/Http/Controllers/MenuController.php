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
     * Format the menu response.
     */
    public function formatMenuResponse($menu): array
    {
        return [
            'id' => $menu->id,
            'title' => $menu->title,
            'soup' => $menu->meals[0]->name,
            'main_meal' => $menu->meals[1]->name,
            'side_dish' => $menu->meals[2]->name,
            'dessert' => $menu->meals[3]->name,
            'daily_menu_title' => $menu->dailyMenu->title
        ];
    }

    /**
     * Display all menus from the database.
     */
    public function index()
    {
        $menus = Menu::with('meals')->get();
        $response = [];

        foreach ($menus as $menu) {
            $response[] = $this->formatMenuResponse($menu);
        }

        return response()->json($response);
    }

    /**
     * Store a newly created menu in the database.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'soup' => 'required|exists:meals,name',
                'main_meal' => 'required|exists:meals,name',
                'side_dish' => 'required|exists:meals,name',
                'dessert' => 'required|exists:meals,name',
                'daily_menu_title' => 'required|exists:daily_menus,title'
            ]);

            $title = $validated['title'];
            $soupId = Meal::query()->where('name', $validated['soup'])->firstOrFail()->id;
            $mainMealId = Meal::query()->where('name', $validated['main_meal'])->firstOrFail()->id;
            $sideDishId = Meal::query()->where('name', $validated['side_dish'])->firstOrFail()->id;
            $dessertId = Meal::query()->where('name', $validated['dessert'])->firstOrFail()->id;
            $dailyMenuId = DailyMenu::query()->where('title', $validated['daily_menu_title'])->firstOrFail()->id;

            $menu = Menu::query()->create([
                'title' => $title,
                'daily_menu_id' => $dailyMenuId
            ]);

            $menu->meals()->attach([$soupId, $mainMealId, $sideDishId, $dessertId]);

            $menu->dailyMenu()->associate($dailyMenuId);

            return response()->json(['message' => 'Menu created successfully', 'menu' => $menu], 201);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Menu not found'], 404);
        }
    }

    /**
     * Display the specified menu.
     */
    public function show(string $id)
    {
        try {
            $menu = Menu::with('meals')->findOrFail($id);

            $response[] = $this->formatMenuResponse($menu);

            return response()->json($response);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Menu not found'], 404);
        }
    }

    /**
     * Update the specified menu in the database.
     */
    public function update(Request $request, string $id)
    {
        try {
            $menu = Menu::query()->findOrFail($id);

            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'soup' => 'required|exists:meals,name',
                'main_meal' => 'required|exists:meals,name',
                'side_dish' => 'required|exists:meals,name',
                'dessert' => 'required|exists:meals,name',
                'daily_menu_title' => 'required|exists:daily_menus,title'
            ]);

            $soupId = Meal::query()->where('name', $validated['soup'])->firstOrFail()->id;
            $mainMealId = Meal::query()->where('name', $validated['main_meal'])->firstOrFail()->id;
            $sideDishId = Meal::query()->where('name', $validated['side_dish'])->firstOrFail()->id;
            $dessertId = Meal::query()->where('name', $validated['dessert'])->firstOrFail()->id;
            $dailyMenuId = DailyMenu::query()->where('title', $validated['daily_menu_title'])->firstOrFail()->id;

            $menu->update(['title' => $validated['title']]);

            $menu->meals()->sync([$soupId, $mainMealId, $sideDishId, $dessertId]);

            $menu->dailyMenu()->dissociate();
            $menu->dailyMenu()->associate($dailyMenuId);

            $menu->save();

            return response()->json(['message' => 'Menu updated successfully', 'menu' => $this->show($menu->id)]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Menu not found'], 404);
        }
    }

    /**
     * Remove the specified menu from the database.
     */
    public function destroy(string $id)
    {
        try {
            $menu = Menu::query()->findOrFail($id);

            $menu->meals()->detach();

            $menu->dailyMenu()->dissociate();

            $menu->delete();

            return response()->json(['message' => 'Menu deleted successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Menu not found'], 404);
        }
    }
}

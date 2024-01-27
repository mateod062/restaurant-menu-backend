<?php

namespace App\Http\Controllers;

use App\Models\DailyMenu;
use App\Models\Menu;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class DailyMenuController extends Controller
{

    /**
     * Format the daily menu response.
     */
    public function formatDailyMenuResponse($dailyMenu): array
    {
        $menus = Menu::with('meals')->where('daily_menu_id', $dailyMenu->id)->get();
        $menusFormatted = [];

        foreach ($menus as $menu) {
            $menusFormatted[] = (new MenuController)->formatMenuResponse($menu);
        }

        return [
            'id' => $dailyMenu->id,
            'title' => $dailyMenu->title,
            'menus' => $menusFormatted
        ];
    }

    /**
     * Display all daily menus from the database.
     */
    public function index()
    {
        $dailyMenus = DailyMenu::with('menus')->get();
        $response = [];

        foreach ($dailyMenus as $dailyMenu) {
            $response[] = $this->formatDailyMenuResponse($dailyMenu);
        }

        return response()->json($response);
    }

    /**
     * Store a newly created daily menu in the database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|unique:daily_menus'
        ]);

        $dailyMenu = DailyMenu::query()->create($validated);
        return response()->json(['message' => 'Daily menu created successfully', 'daily_menu' => $dailyMenu], 201);
    }

    /**
     * Display the specified daily menu.
     */
    public function show(string $id)
    {
        try {
            $dailyMenu = DailyMenu::with('menus')->findOrFail($id);

            $response = [];

            $menus = Menu::with('meals')->where('daily_menu_id', $dailyMenu->id)->get();
            $menusFormatted = [];

            foreach ($menus as $menu) {
                $menusFormatted[] = (new MenuController)->formatMenuResponse($menu);
            }

            $response[] = [
                'id' => $dailyMenu->id,
                'title' => $dailyMenu->date,
                'menus' => $menusFormatted
            ];

            return response()->json($response);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Daily menu not found'], 404);
        }
    }

    /**
     * Update the daily menu in the database.
     */
    public function update(Request $request, string $id)
    {
        try {
            $dailyMenu = DailyMenu::query()->findOrFail($id);

            $validated = $request->validate([
                'title' => 'required|date|unique:daily_menus'
            ]);

            $dailyMenu->update($validated);

            $dailyMenu = $this->formatDailyMenuResponse($dailyMenu);

            return response()->json(['message' => 'Daily menu updated successfully', 'daily_menu' => $dailyMenu], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Daily menu not found'], 404);
        }
    }

    /**
     * Remove the daily menu from the database
     */
    public function destroy(string $id)
    {
        try {
            $dailyMenu = DailyMenu::query()->findOrFail($id);

            $menus = Menu::query()->where('daily_menu_id', $dailyMenu->id)->get();
            foreach ($menus as $menu) {
                (new MenuController)->destroy($menu->id);
            }

            $dailyMenu->delete();
            return response()->json(['message' => 'Daily menu deleted successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Daily menu not found'], 404);
        }
    }
}

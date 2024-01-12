<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Menu
 *
 * @property int $id
 * @property int $daily_menu_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\DailyMenu $dailyMenu
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Meal> $desserts
 * @property-read int|null $desserts_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Meal> $mainMeals
 * @property-read int|null $main_meals_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Meal> $sideDishes
 * @property-read int|null $side_dishes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Meal> $soups
 * @property-read int|null $soups_count
 * @method static \Illuminate\Database\Eloquent\Builder|Menu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu query()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereDailyMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Menu extends Model
{
    use HasFactory;

    public function soups()
    {
        return $this->belongsToMany(Meal::class, 'menu_meal', 'menu_id', 'soup_id');
    }

    public function mainMeals()
    {
        return $this->belongsToMany(Meal::class, 'menu_meal', 'menu_id', 'main_meal_id');
    }

    public function sideDishes()
    {
        return $this->belongsToMany(Meal::class, 'menu_meal', 'menu_id', 'side_dish_id');
    }

    public function desserts()
    {
        return $this->belongsToMany(Meal::class, 'menu_meal', 'menu_id', 'dessert_id');
    }

    public function dailyMenu()
    {
        return $this->belongsTo(DailyMenu::class, 'daily_menu_id');
    }
}

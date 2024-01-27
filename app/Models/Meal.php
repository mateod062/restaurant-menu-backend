<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Meal
 *
 * @property int $id
 * @property string $name
 * @property string $price
 * @property string $category
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Meal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Meal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Meal query()
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereUpdatedAt($value)
 * @mixin \Eloquent
 * @mixin \Illuminate\Database\Query\Builder
 */
class Meal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'price'
    ];

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'meal_menu', 'meal_id', 'menu_id');
    }
}

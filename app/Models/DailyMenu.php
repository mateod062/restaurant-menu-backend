<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DailyMenu
 *
 * @property int $id
 * @property string $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Menu> $menus
 * @property-read int|null $menus_count
 * @method static \Illuminate\Database\Eloquent\Builder|DailyMenu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DailyMenu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DailyMenu query()
 * @method static \Illuminate\Database\Eloquent\Builder|DailyMenu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DailyMenu whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DailyMenu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DailyMenu whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DailyMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'date'
    ];

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}

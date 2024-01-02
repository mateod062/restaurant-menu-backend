<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    public function meals()
    {
        return $this->belongsToMany(Meal::class);
    }

    public function dailyMenu()
    {
        return $this->belongsTo(DailyMenu::class);
    }
}

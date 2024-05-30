<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    public $table = 'conf_menu';

    public function subMenus()
    {
        return $this->hasMany(SubMenus::class, 'menu_id');
    }
}

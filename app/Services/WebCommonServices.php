<?php
namespace App\Services;
use App\Models\Menu;
class WebCommonServices{

    public function webMenus()
    {
        return Menu::with('childMenus')->condition('web')->order()->get();
    }
    public function tiaoMenus()
    {
        return Menu::with('childMenus')->condition('tiao')->order()->get();
    }
}
?>
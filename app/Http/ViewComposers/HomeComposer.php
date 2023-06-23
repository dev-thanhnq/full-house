<?php


namespace App\Http\ViewComposers;


use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
//use Illuminate\Support\Facades\View;

class HomeComposer
{
    public $listCategories = [];

    public function __construct(){

        $this->listCategories = Cache::remember('listCategories', 60*60, function () {
            $listCategories = Category::get();
            return $listCategories;
        });
    }

    public function compose(View $view) {

        $view->with(['listCategories' => $this->listCategories]);
    }
}

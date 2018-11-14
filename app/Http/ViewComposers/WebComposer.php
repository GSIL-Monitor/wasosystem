<?php
namespace App\Http\ViewComposers;
use App\Services\WebCommonServices;
use Illuminate\View\View;
class WebComposer{
    private $data;
    public function __construct(WebCommonServices $commonServices)
    {
        $this->data =$commonServices;
    }

    public function compose(View $view)
    {
        $view->with(['nav'=> [
             'WebMenus'=>$this->data->webMenus(),
             'TiaoMenus'=>$this->data->tiaoMenus()
        ]]);//填充数据
    }

}
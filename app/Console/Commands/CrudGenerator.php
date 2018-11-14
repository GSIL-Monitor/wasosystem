<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class CrudGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:generator
            {name}{title}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create CRUD operations';

    /**
     * CrudGenerator constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        $title = $this->argument('title');
        $this->controller($name,$title);
        $this->service($name,$title);
        $this->model($name,$title);
        $this->request($name,$title);
        $this->viewIndex($name);
        $this->viewCreateAndEdit($name);
        $this->viewForm($name);
        $this->migrations($name,$title);
        //将当前添加的权限添加给超级管理员
        $super_admin = Role::where('id', '=', 1)->firstOrFail(); //将输入角色匹配
        //将当前添加的权限添加给企划
        $layout_admin = Role::where('id', '=', 2)->firstOrFail(); //将输入角色匹配
        $show_add_edit_del=[
            ['name'=>'show '.strtolower(str_plural(snake_case($name))), 'title'=>$title.'查看'],
            ['name'=>'create '.strtolower(str_plural(snake_case($name))), 'title'=>$title.'添加'],
            ['name'=>'edit '.strtolower(str_plural(snake_case($name))), 'title'=>$title.'修改'],
            ['name'=>'delete '.strtolower(str_plural(snake_case($name))), 'title'=>$title.'删除'],
        ];
        foreach ($show_add_edit_del as $v){
            $permission=Permission::create($v);
            $permission->syncRoles([$super_admin,$layout_admin]);
        }
//        File::append(base_path('routes/web.php'), PHP_EOL.'/*-----------------------------'.$title.'-----------------------------*/'.PHP_EOL.'$router->resource(\'' . strtolower(str_plural(snake_case($name))) . "', '{$name}Controller', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);").PHP_EOL;
         $this->webRoute($name,$title);
    }
    /*---------------------     -获取文件-       ---------------------*/
    protected function getStub($type)
    {
        return file_get_contents(resource_path("stubs/$type.stub"));
    }
    /*---------------------     -转换Web.php-       ---------------------*/
    protected function webRoute($name,$title)
    {
        $modelTemplate = str_replace(
            [
                '/*-*/',
            ],
            [
                PHP_EOL.'   /*-----------------------------'.$title.'-----------------------------*/'.PHP_EOL.'   $router->resource(\'' . strtolower(str_plural(snake_case($name))) . "', '{$name}Controller', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);".PHP_EOL.'/*-*/'
            ],
            file_get_contents(base_path('routes/web.php'))
        );

        file_put_contents(base_path('routes/web.php'), $modelTemplate);
    }
    /*---------------------     -转换Model-       ---------------------*/
    protected function model($name,$title)
    {
        $modelTemplate = str_replace(
            [
                '{{modelName}}',
               '{{modelTitle}}'
            ],
            [
                $name,
                $title
            ],
            $this->getStub('Model')
        );

        file_put_contents(app_path("Models/{$name}.php"), $modelTemplate);
    }
    /*---------------------     -转换Controller-       ---------------------*/
    protected function controller($name,$title)
    {
        $controllerTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}',
                '{{modelTitle}}'
            ],
            [
                $name,
                strtolower(str_plural(snake_case($name))),
                strtolower(snake_case($name)),
                $title
            ],
            $this->getStub('Controller')
        );

        file_put_contents(app_path("/Http/Controllers/Admin/{$name}Controller.php"), $controllerTemplate);
    }
    /*---------------------     -转换Service-       ---------------------*/
    protected function service($name,$title)
    {
        $serviceTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}',
                '{{modelTitle}}'
            ],
            [
                $name,
                strtolower(str_plural(snake_case($name))),
                strtolower(snake_case($name)),
                $title
            ],
            $this->getStub('Services')
        );

        file_put_contents(app_path("Services/{$name}Services.php"), $serviceTemplate);
    }
    /*---------------------     -转换Request-       ---------------------*/
    protected function request($name,$title)
    {
        $requestTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelTitle}}'
            ],
            [
                $name,
                $title
            ],
            $this->getStub('Request')
        );

        if (!file_exists($path = app_path('/Http/Requests')))
            mkdir($path, 0777, true);

        file_put_contents(app_path("/Http/Requests/{$name}Request.php"), $requestTemplate);
    }
    /*---------------------     -转换Index视图文件-       ---------------------*/
    protected function viewIndex($name)
    {
        $viewIndexTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}'
            ],
            [
                $name,
                strtolower(str_plural(snake_case($name))),
                strtolower(snake_case($name))
            ],
            $this->getStub('views/index')
        );
        if (!file_exists($path = resource_path('views/admin/'.strtolower(str_plural(snake_case($name))))))
            mkdir($path, 0777, true);
        file_put_contents(resource_path("views/admin/".strtolower(str_plural(snake_case($name)))."/index.blade.php"), $viewIndexTemplate);
    }
    /*---------------------     -转换form视图文件-       ---------------------*/
    protected function viewForm($name)
    {
        $viewFormTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}'
            ],
            [
                $name,
                strtolower(str_plural(snake_case($name))),
                strtolower(snake_case($name))
            ],
            $this->getStub('views/form')
        );

        file_put_contents(resource_path("views/admin/".strtolower(str_plural(snake_case($name)))."/form.blade.php"), $viewFormTemplate);
    }
    /*---------------------     -转换create_and_edit视图文件-       ---------------------*/
    protected function viewCreateAndEdit($name)
    {
        $viewCreateAndEditTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}'
            ],
            [
                $name,
                strtolower(str_plural(snake_case($name))),
                strtolower(snake_case($name))
            ],
            $this->getStub('views/create_and_edit')
        );

        file_put_contents(resource_path("views/admin/".strtolower(str_plural(snake_case($name)))."/create_and_edit.blade.php"), $viewCreateAndEditTemplate);
    }
    /*---------------------     -转换migrations文件-       ---------------------*/
    protected function migrations($name,$title)
    {
        $migrationsTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}',
                '{{modelTitle}}'
            ],
            [
                str_plural($name),
                strtolower(str_plural(snake_case($name))),
                strtolower($name),
                $title,
            ],
            $this->getStub('migrations/migration')
        );
        $migrationsname = date('Y_m_d_His').'_create_'.strtolower(str_plural(snake_case($name))).'_table';
        file_put_contents(database_path("migrations/".$migrationsname.".php"), $migrationsTemplate);
    }
}

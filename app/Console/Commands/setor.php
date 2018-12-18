<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class setor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'set:width';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
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

        $this->width();
    }

    public function width()
    {
        $str="";
        for ($x=1; $x<=200; $x++) {
            if($x % 5 == 0){
                $str.=".zyw_w".$x.'{ width:'.$x.'px !important}'.PHP_EOL;
            }else{
                $str.=".zyw_w".$x.'{ width:'.$x.'px !important}';
            }

        }
        file_put_contents(public_path('admin/css/common.css'), $str);
    }
}

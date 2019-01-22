<?php

namespace App\Console\Commands;

use App\Models\CompleteMachine;
use App\Models\Product;
use App\Models\ProductGood;
use Illuminate\Console\Command;

class UpdatePrice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'price:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '整机价格更新和自建平台价格更新';

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
        $this->updateCompleteMachine();
        $this->updateSelfBuildTerraces();
    }



    public function updateCompleteMachine()
    {
        $complete_machines= CompleteMachine::with('complete_machine_product_goods')->latest()->get();
        $complete_machines->map(function ($item){
            $item->price=priceSum($item->complete_machine_product_goods);
            $item->save();
        });
        \Log::info('整机产品更新价格成功！');
    }
    public function updateSelfBuildTerraces(){
        $self_build_terraces = ProductGood::with('product_goods_self_build_terrace')->whereJiagouId(279)->latest()->get();
        $self_build_terraces->map(function ($item){
            $item->price=priceSum($item->product_goods_self_build_terrace);
            $item->save();
        });
        \Log::info('自建产品更新价格成功！');
    }
}

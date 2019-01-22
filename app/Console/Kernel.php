<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\UpdatePrice::class,
        \App\Console\Commands\MysqlToEmail::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //每天午夜执行一清除备份任务（每天1点）
        $schedule->command('backup:clean')->daily()->at('01:00')->withoutOverlapping();
        //每半个小时执行一次数据库备份任务
        $schedule->command('backup:run --only-db')
            ->everyThirtyMinutes()
            ->after(function () use (&$schedule) {
                \Log::info('创建数据库备份成功');
            })->withoutOverlapping();
        //备份完成后没半个小时将最新的备份发送到邮箱
        $schedule->command('backup:email')
            ->everyThirtyMinutes()
            ->withoutOverlapping();
        //每一个小时更新自建平台价格和整机价格
        //限制任务在工作日执行  并且 限制任务在（8点-17点）执行
        $schedule->command('price:update')
            ->weekdays()
            ->hourly()
            ->timezone('Asia/Shanghai')
            ->between('8:00', '17:00')->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}

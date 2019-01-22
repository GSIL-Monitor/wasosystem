<?php

namespace App\Console\Commands;

use App\Mail\MysqlBackupToEmai;
use App\Models\Order;
use Illuminate\Console\Command;

class MysqlToEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:email';

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
        \Mail::to(config('mail.accept_email'))->queue(new MysqlBackupToEmai());
        \Log::info('最新数据库备份发送邮件成功');
    }
}

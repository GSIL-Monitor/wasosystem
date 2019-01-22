<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MysqlBackupToEmai extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $zip_path=public_path('storage/Waso/');
        $files=scandir($zip_path);
        // 取出文件
        $new_backup =array_first(array_reverse(array_filter($files, function ($value) {
            return $value !='.' &&   $value !='..';
        })));
        $new_backup_url=$zip_path.'/'.$new_backup;
        return $this->view('emails.mysql_backup')->subject("网烁客服系统")->with([
            'name'=>'最新的数据库备份'.$new_backup,
        ])->attach($new_backup_url);
    }
}

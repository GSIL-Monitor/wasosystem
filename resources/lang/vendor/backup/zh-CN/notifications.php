<?php

return [
    'exception_message' => '异常消息: :message',
    'exception_trace' => '异常跟踪: :trace',
    'exception_message_title' => '异常消息',
    'exception_trace_title' => '异常跟踪',

    'backup_failed_subject' => '备份失败 :application_name',
    'backup_failed_body' => '重要提示:备份时发生错误 :application_name',

    'backup_successful_subject' => '成功备份 :application_name',
    'backup_successful_subject_title' => '成功的新备份!',
    'backup_successful_body' => '好消息，一个新的备份 :application_name 在磁盘上成功创建 :disk_name.',

    'cleanup_failed_subject' => '清理备份 :application_name 失败.',
    'cleanup_failed_body' => '在清理备份时发生错误 :application_name',

    'cleanup_successful_subject' => '清除 :application_name 备份成功',
    'cleanup_successful_subject_title' => '清除备份成功!',
    'cleanup_successful_body' => '清除磁盘上名为 :application_name 的备份 :disk_name 成功.',

    'healthy_backup_found_subject' => '磁盘上的 :application_name 备份 :disk_name 是完整的',
    'healthy_backup_found_subject_title' => ':application_name 的备份是完整的',
    'healthy_backup_found_body' => ':application_name 的备份被认为是完整的',

    'unhealthy_backup_found_subject' => '重要提示:  :application_name 的备份是不完整的',
    'unhealthy_backup_found_subject_title' => '重要提示:  :application_name 的备份是不完整的. :problem',
    'unhealthy_backup_found_body' => '磁盘上的 :application_name 的 :disk_name 备份是不完整的.',
    'unhealthy_backup_found_not_reachable' => '无法完成备份目标. :error',
    'unhealthy_backup_found_empty' => '这个应用程序没有备份.',
    'unhealthy_backup_found_old' => '最新的备份日期 :date 这不是最新的备份日期.',
    'unhealthy_backup_found_unknown' => '对不起，不能确定具体是什么原因.',
    'unhealthy_backup_found_full' => '备份使用了太多的存储。当前使用情况 :disk_usage 它大于 :disk_limit.',
];

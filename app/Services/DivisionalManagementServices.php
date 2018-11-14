<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\DivisionalManagement;

class DivisionalManagementServices
{
    public function add_member($members,$pid)
    {
        $admin = Admin::whereIn('id', $members)->get();
        if ($admin->isNotEmpty()) {
            foreach ($admin as $value) {
                $arr['name']=$value->name;
                $arr['parent_id']=$pid;
                $arr['admin_id']=$value->id;
                $arr['identifying']='member';
                DivisionalManagement::create($arr);
            }
        }
    }


}

?>
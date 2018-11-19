<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

//视频管理Model
class Video extends Model
{
    protected $casts = ['complete_category' => 'array', 'complete_machine' => 'array', 'file' => 'array'];
    protected $fillable = ['name', 'url', 'complete_category', 'complete_machine', 'file'];

    public function setCompleteCategoryAttribute($value)
    {
        return $this->attributes['complete_category'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function setCompleteMachineAttribute($value)
    {
        return $this->attributes['complete_machine'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function setFileAttribute($value)
    {
        return $this->attributes['file'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function framework_video()
    {
        return $this->belongsToMany(CompleteMachineFrameworks::class, 'video_frame_works', 'video_id', 'complete_machine_framework_id');
    }

    public function complete_machine_video()
    {
        return $this->belongsToMany(CompleteMachine::class, 'video_complete_machines');
    }

    public function getMp4Attribute()
    {
        $file=[];
        if (Storage::drive('public')->exists($this->file['url'][0])) {
            $file[0]['url'] = env('IMAGES_URL') . $this->file['url'][0];
            $file[0]['url_name'] = $this->file['url'][0];
            $file[0]['name'] = $this->file['name'][0];
            $file[0]['suffix'] = str_after($this->file['url'][0], '.');
        }
        return $file;
    }
}
<?php

namespace App\Models;

use App\Models\HistoryLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded=[];

    public function paymentDocumentType()
    {
        // Get Payment Document Extension
        $ext = pathinfo($this->url, PATHINFO_EXTENSION);

        if (in_array($ext, array('jpg', 'png', 'jpeg'))) {
            return "image";
        }elseif($ext == 'pdf'){
            return "pdf";
        }else{
            return null;
        }
    }

    public function syndicate()
    {
        return $this->belongsTo(Syndicate::class);
    }
    public static function boot() {
        parent::boot();

        if(auth()->check()){
            // Model Events
            static::created(function($item) {
                // Log Action
                HistoryLog::create([
                    'username'=> auth()->user()->username,
                    'action_type'=> 'create',
                    'table_name'=>'documents',
                    'description'=>'Create a Documents with name '.$item->name,
                ]);
            });

            static::deleted(function($item) {
                // Log Action
                HistoryLog::create([
                    'username'=> auth()->user()->username,
                    'action_type'=> 'delete',
                    'table_name'=>'documents',
                    'description'=>'Delete a Documents with name '.$item->name,
                ]);
            });

            static::updated(function($item) {
                // Log Action
                HistoryLog::create([
                    'username'=> auth()->user()->username,
                    'action_type'=> 'update',
                    'table_name'=>'documents',
                    'description'=>'Update a Documents with name '.$item->name,
                ]);
            });
        }
    }
}

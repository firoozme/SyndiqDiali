<?php

namespace App\Models;

use App\Models\Resident;
use App\Models\HistoryLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fee extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded =[];
    public function syndicate()
    {
        return $this->belongsTo(Syndicate::class)->withTrashed();
    }
    public function resident()
    {
        return $this->belongsTo(Resident::class)->withTrashed();
    }

    public function paymentDocumentType()
    {
        // Get Payment Document Extension
        $ext = pathinfo($this->payment_document, PATHINFO_EXTENSION);

        if (in_array($ext, array('jpg', 'png', 'jpeg'))) {
            return "image";
        }elseif($ext == 'pdf'){
            return "pdf";
        }else{
            return null;
        }
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
                    'table_name'=>'fees',
                    'description'=>'Create a Fee with ID '.$item->id,
                ]);
            });

            static::deleted(function($item) {
                // Log Action
                HistoryLog::create([
                    'username'=> auth()->user()->username,
                    'action_type'=> 'delete',
                    'table_name'=>'fees',
                    'description'=>'Delete a Fee with ID '.$item->id,
                ]);
            });

            static::updated(function($item) {
                // Log Action
                HistoryLog::create([
                    'username'=> auth()->user()->username,
                    'action_type'=> 'update',
                    'table_name'=>'fees',
                    'description'=>'Update a Fee with ID '.$item->id,
                ]);
            });
        }
    }
}

<?php

namespace App\Models;

use App\Models\Syndicate;
use App\Models\HistoryLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resident extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'cin',
        'phone',
        'address',
        'syndicate_id',
        'role',
    ];

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
                    'table_name'=>'residents',
                    'description'=>'Create a Resident with name '.$item->name,
                ]);
            });

            static::deleted(function($item) {
                // Log Action
                HistoryLog::create([
                    'username'=> auth()->user()->username,
                    'action_type'=> 'delete',
                    'table_name'=>'residents',
                    'description'=>'Delete a Resident with name '.$item->name,
                ]);
            });

            static::updated(function($item) {
                // Log Action
                HistoryLog::create([
                    'username'=> auth()->user()->username,
                    'action_type'=> 'update',
                    'table_name'=>'residents',
                    'description'=>'Update a Resident with name '.$item->name,
                ]);
            });
        }
    }
    
}

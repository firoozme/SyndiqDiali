<?php

namespace App\Models;

use App\Models\User;
use App\Models\Document;
use App\Models\Resident;
use App\Models\HistoryLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Syndicate extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $guarded = [];

    public function residents()
    {
        return $this->hasMany(Resident::class);
    }

    public function president()
    {
        return $this->belongsTo(Resident::class,'president_id','id');
    }
    public function vicepresident()
    {
        return $this->belongsTo(Resident::class,'vice_president_id','id');
    }

    public function fees()
    {
        return $this->hasMany(Fee::class);
    }
    public function documents()
    {
        return $this->hasMany(Document::class);
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
                    'table_name'=>'syndicates',
                    'description'=>'Create a Syndicate with name '.$item->name,
                ]);
            });

            static::deleted(function($item) {
                // Log Action
                HistoryLog::create([
                    'username'=> auth()->user()->username,
                    'action_type'=> 'delete',
                    'table_name'=>'syndicates',
                    'description'=>'Delete a Syndicate with name '.$item->name,
                ]);
            });

            static::updated(function($item) {
                // Log Action
                HistoryLog::create([
                    'username'=> auth()->user()->username,
                    'action_type'=> 'update',
                    'table_name'=>'syndicates',
                    'description'=>'Update a Syndicate with name '.$item->name,
                ]);
            });
        }
    }
}

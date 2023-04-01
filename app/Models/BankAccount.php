<?php

namespace App\Models;

use App\Models\Syndicate;
use App\Models\HistoryLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BankAccount extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'name', 'iban', 'rib', 'bic' , 'syndicate_id'
    ];

    public function syndicate()
    {
        return $this->belongsTo(Syndicate::class)->withTrashed();
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
                    'table_name'=>'bank_accounts',
                    'description'=>'Create a Bank Account with name '.$item->name,
                ]);
            });

            static::deleted(function($item) {
                // Log Action
                HistoryLog::create([
                    'username'=> auth()->user()->username,
                    'action_type'=> 'delete',
                    'table_name'=>'bank_accounts',
                    'description'=>'Delete a Bank Account with name '.$item->name,
                ]);
            });

            static::updated(function($item) {
                // Log Action
                HistoryLog::create([
                    'username'=> auth()->user()->username,
                    'action_type'=> 'update',
                    'table_name'=>'bank_accounts',
                    'description'=>'Update a Bank Account with name '.$item->name,
                ]);
            });
        }
    }
    
}

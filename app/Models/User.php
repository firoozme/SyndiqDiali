<?php

namespace App\Models;

use App\Models\User;
use App\Models\HistoryLog;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
        'email',
        'phone',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    


    public static function boot() {
        parent::boot();

        if(auth()->check()){
            // Model Events
            static::created(function($item) {
                // Log Action
                HistoryLog::create([
                    'username'=> auth()->user()->username,
                    'action_type'=> 'create',
                    'table_name'=>'users',
                    'description'=>'Create a new user with username '.$item->username,
                ]);
            });

            static::deleted(function($item) {
                // Log Action
                HistoryLog::create([
                    'username'=> auth()->user()->username,
                    'action_type'=> 'delete',
                    'table_name'=>'users',
                    'description'=>'Delete a user with username '.$item->username,
                ]);
            });

            static::updated(function($item) {
                // Log Action
                HistoryLog::create([
                    'username'=> auth()->user()->username,
                    'action_type'=> 'update',
                    'table_name'=>'users',
                    'description'=>'Update a user with username '.$item->username,
                ]);
            });
        }
    }


}

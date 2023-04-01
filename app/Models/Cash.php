<?php

namespace App\Models;

use App\Models\Syndicate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cash extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded =[];
    
    public function syndicate()
    {
        return $this->belongsTo(Syndicate::class)->withTrashed();
    }
}

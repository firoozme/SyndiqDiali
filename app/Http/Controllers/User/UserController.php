<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function delete($id)
    {
        $user = User::findOrFail($id);
        if(auth()->user()->id == $id){
            $this->emit('sweet',[
                'title'=> 'Error!',
                'text'=> 'You Cannot Delete Yourself',
                'icon'=> 'error',
            ]);
        }else{

        }
    }
}

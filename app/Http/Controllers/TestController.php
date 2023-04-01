<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\Syndicate;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class TestController extends Controller
{
    
    public function toPdf($syndicate_id)
    {
        $syndicate = Syndicate::findOrFail($syndicate_id);
        $president = Resident::where('syndicate_id', $syndicate_id)->where('role','president')->first();
        $visePresident = Resident::where('syndicate_id', $syndicate_id)->where('role','vise_president')->first();
        $data = [
            'syndicate' => $syndicate,
            'president' => $president,
            'visePresident' => $visePresident
        ];
        $pdf = Pdf::loadView('test', $data); 


        return $pdf->download('contract.pdf');
    }
}

<?php

namespace App\Http\Controllers\api\v1;

use App\Models\HistoryLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\historyLogResource;
use App\Traits\apiTrait;

class historyLogController extends Controller
{
    use apiTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $HistoryLogs = HistoryLog::latest()->paginate(10); 
            return $this->responseStatus('Get All History Logs', [
                'data' => historyLogResource::collection($HistoryLogs),
                'link' => historyLogResource::collection($HistoryLogs)->response()->getData()->links,
                'meta' => historyLogResource::collection($HistoryLogs)->response()->getData()->meta,
            ], 'success', 200);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    
}

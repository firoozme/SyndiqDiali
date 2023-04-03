<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Cash;
use App\Traits\apiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\CashResource;
use Illuminate\Support\Facades\Validator;

class CashController extends Controller
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
            $cashes = Cash::latest()->paginate(10); 
            return $this->responseStatus('Get All Cashes', [
                'data' => CashResource::collection($cashes),
                'link' => CashResource::collection($cashes)->response()->getData()->links,
                'meta' => CashResource::collection($cashes)->response()->getData()->meta,
            ], 'success', 200);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'syndicate' => 'required|exists:syndicates,id',
            'amount' => 'required|numeric',
            'code_operation' => 'required',
            'date_operation' => 'required|date',
            'description' => 'nullable',
        ]);

        if($validator->fails()){
            return $this->responseStatus('Cash Create Validation Error', $validator->messages(), 'error', 401);
        }
        DB::beginTransaction();
        $cash = Cash::create([
            'syndicate_id' => $request->syndicate,
            'amount' => $request->amount,
            'code_operation' => $request->code_operation,
            'date_operation' => $request->date_operation,
            "description" => $request->description,
        ]);
         DB::commit();
        
        return $this->responseStatus('Cahs Create Success', new CashResource($cash), 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cash = Cash::find($id);
        if(!$cash){
            return $this->responseStatus('Cash Not Found', '', 'error', 404);
        }
        return $this->responseStatus('Cash detail', new CashResource($cash), 'success', 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cash = Cash::find($id);
        if(!$cash){
            return $this->responseStatus('Cash Not Found', '', 'error', 404);
        }
        $validator = Validator::make($request->all(), [
            'syndicate' => 'required|exists:syndicates,id',
            'amount' => 'required|numeric',
            'code_operation' => 'required',
            'date_operation' => 'required|date',
            'description' => 'nullable',
        ]);

        if($validator->fails()){
            return $this->responseStatus('Cash Update Validation Error', $validator->messages(), 'error', 401);
        }
        
        $cash->update([
            'syndicate_id'   => $request->syndicate,
            'amount'         => $request->amount,
            'code_operation' => $request->code_operation,
            'date_operation' => $request->date_operation,
            'description'    => $request->description,
        ]);
        
        return $this->responseStatus('Cash Updated Successfully', new CashResource($cash), 'success', 201);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $cash =Cash::find($id);
        if(!$cash){
            return $this->responseStatus('Cash Not Found', '', 'Error', 404); 
        }
        $cash->delete();
        return $this->responseStatus('Cash Deleted Success', '', '',  200);
        
    }
}

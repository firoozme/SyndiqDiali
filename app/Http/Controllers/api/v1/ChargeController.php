<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Charge;
use App\Traits\apiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChargeResource;
use Illuminate\Support\Facades\Validator;

class ChargeController extends Controller
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
            $cashes = Charge::latest()->paginate(10); 
            return $this->responseStatus('Get All Charge', [
                'data' => ChargeResource::collection($cashes),
                'link' => ChargeResource::collection($cashes)->response()->getData()->links,
                'meta' => ChargeResource::collection($cashes)->response()->getData()->meta,
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
            return $this->responseStatus('Charge Create Validation Error', $validator->messages(), 'error', 401);
        }
        DB::beginTransaction();
        $charge = Charge::create([
            'syndicate_id' => $request->syndicate,
            'amount' => $request->amount,
            'code_operation' => $request->code_operation,
            'date_operation' => $request->date_operation,
            "description" => $request->description,
        ]);
         DB::commit();
        
        return $this->responseStatus('Charge Create Success', new ChargeResource($charge), 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $charge = Charge::find($id);
        if(!$charge){
            return $this->responseStatus('Charge Not Found', '', 'error', 404);
        }
        return $this->responseStatus('Charge detail', new ChargeResource($charge), 'success', 201);
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
        $charge = Charge::find($id);
        if(!$charge){
            return $this->responseStatus('Charge Not Found', '', 'error', 404);
        }
        $validator = Validator::make($request->all(), [
            'syndicate' => 'required|exists:syndicates,id',
            'amount' => 'required|numeric',
            'code_operation' => 'required',
            'date_operation' => 'required|date',
            'description' => 'nullable',
        ]);

        if($validator->fails()){
            return $this->responseStatus('Charge Update Validation Error', $validator->messages(), 'error', 401);
        }
        
        $charge->update([
            'syndicate_id'   => $request->syndicate,
            'amount'         => $request->amount,
            'code_operation' => $request->code_operation,
            'date_operation' => $request->date_operation,
            'description'    => $request->description,
        ]);
        
        return $this->responseStatus('Charge Updated Successfully', new ChargeResource($charge), 'success', 201);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $charge =Charge::find($id);
        if(!$charge){
            return $this->responseStatus('Charge Not Found', '', 'Error', 404); 
        }
        $charge->delete();
        return $this->responseStatus('Charge Deleted Success', '', '',  200);
        
    }
}

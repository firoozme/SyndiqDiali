<?php

namespace App\Http\Controllers\api\v1;

use App\Traits\apiTrait;
use Illuminate\Http\Request;
use App\Models\CompanyCharge;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\companyChargeResource;

class companyChargeController extends Controller
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
            $companyCharges = CompanyCharge::latest()->paginate(10); 
            return $this->responseStatus('Get All Company Charges', [
                'data' => companyChargeResource::collection($companyCharges),
                'link' => companyChargeResource::collection($companyCharges)->response()->getData()->links,
                'meta' => companyChargeResource::collection($companyCharges)->response()->getData()->meta,
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
            'amount' => 'required|numeric',
            'code_operation' => 'required',
            'date_operation' => 'required|date',
            'description' => 'nullable',
        ]);

        if($validator->fails()){
            return $this->responseStatus('Company Charge Create Validation Error', $validator->messages(), 'error', 401);
        }
        DB::beginTransaction();
        $companyCharge = CompanyCharge::create([
            'amount' => $request->amount,
            'code_operation' => $request->code_operation,
            'date_operation' => $request->date_operation,
            "description" => $request->description,
        ]);
         DB::commit();
        
        return $this->responseStatus('Company Charge Create Success', new companyChargeResource($companyCharge), 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $companyCharge = CompanyCharge::find($id);
        if(!$companyCharge){
            return $this->responseStatus('Company Charge Not Found', '', 'error', 404);
        }
        return $this->responseStatus('Company Charge detail', new companyChargeResource($companyCharge), 'success', 201);
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
        $companyCharge = CompanyCharge::find($id);
        if(!$companyCharge){
            return $this->responseStatus('Company Charge Not Found', '', 'error', 404);
        }
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric',
            'code_operation' => 'required',
            'date_operation' => 'required|date',
            'description' => 'nullable',
        ]);

        if($validator->fails()){
            return $this->responseStatus('Company Charge Update Validation Error', $validator->messages(), 'error', 401);
        }
        
        $companyCharge->update([
            'amount'         => $request->amount,
            'code_operation' => $request->code_operation,
            'date_operation' => $request->date_operation,
            'description'    => $request->description,
        ]);
        
        return $this->responseStatus('Company Charge Updated Successfully', new companyChargeResource($companyCharge), 'success', 201);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $companyCharge =CompanyCharge::find($id);
        if(!$companyCharge){
            return $this->responseStatus('Company Charge Not Found', '', 'Error', 404); 
        }
        $companyCharge->delete();
        return $this->responseStatus('Company Charge Deleted Success', '', '',  200);
        
    }
}

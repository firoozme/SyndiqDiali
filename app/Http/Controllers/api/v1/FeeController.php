<?php

namespace App\Http\Controllers\api\v1;

use Carbon\Carbon;
use App\Models\Fee;
use App\Models\Resident;
use App\Traits\apiTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\FeeResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class FeeController extends Controller
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
            $fees = Fee::paginate(10); 
            return $this->responseStatus('Get All Fees', [
                'data' => FeeResource::collection($fees),
                'link' => FeeResource::collection($fees)->response()->getData()->links,
                'meta' => FeeResource::collection($fees)->response()->getData()->meta,
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
            'syndicate_item' => 'required|exists:syndicates,id',
            'resident' => 'required|exists:residents,id',
            'amount' => 'required|numeric',
            'code_operation' => 'required',
            'date_operation' => 'required|date',
            'payment_method' => 'required',
            'document' => 'nullable',
        ]);

        $resident = Resident::where('id',$request->syndicate_item)->where('syndicate_id',$request->syndicate_item)->count();
        if(!$resident){
            return $this->responseStatus('this resident is not related to Syndicate', $validator->messages(), 'error', 401);
        }
        if($validator->fails()){
            return $this->responseStatus('Fee Create Validation Error', $validator->messages(), 'error', 401);
        }
        DB::beginTransaction();

            if ($request->document) {
                $file = $request->document;
                $fileName = 'fee_' . Carbon::now()->microsecond . '.' . $file->extension();
                $path = $file->storeAs('/upload/fees/', $fileName, 'my_files');
            }
            $fee = Fee::create([
                'syndicate_id' => $request->syndicate_item,
                'resident_id' => $request->resident,
                'amount' => $request->amount,
                'code_operation' => $request->code_operation,
                'date_operation' => $request->date_operation,
                'payment_method' => $request->payment_method,
                "payment_document" => $fileName ?? null,
            ]);
        
         DB::commit();
        
        return $this->responseStatus('Fee Create Success', new FeeResource($fee), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fee = Fee::find($id);
        if(!$fee){
            return $this->responseStatus('Fee Not Found', '', 'error', 404);
        }
        return $this->responseStatus('Fee detail', new FeeResource($fee), 'success', 201);
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
        $fee = Fee::find($id);
        if(!$fee){
            return $this->responseStatus('Fee Not Found', '', 'error', 404);
        }
        $validator = Validator::make($request->all(), [
            'syndicate_item' => 'required',
            'resident' => 'required',
            'amount' => 'required|numeric',
            'code_operation' => 'required',
            'date_operation' => 'required',
            'payment_method' => 'nullable',
            'new_document' => 'nullable|mimes:jpeg,jpg,png,pdf',
        ]);
        $resident = Resident::where('id',$request->syndicate_item)->where('syndicate_id',$request->syndicate_item)->count();
        if(!$resident){
            return $this->responseStatus('this resident is not related to Syndicate', $validator->messages(), 'error', 401);
        }
        

        if($validator->fails()){
            return $this->responseStatus('Fee Update Validation Error', $validator->messages(), 'error', 401);
        }
        
            $fileName = $fee->payment_document;
            if ($request->new_document) {
                $file = $request->new_document;
                File::delete(public_path() . '/upload/fees/' . $fileName);
                $fileName = 'fee_' . Carbon::now()->microsecond . '.' . $file->extension();
                $path = $file->storeAs('/upload/fees/', $fileName, 'my_files');
            }
            $fee->update([
                'syndicate_id' => $request->syndicate_item,
                'resident_id' => $request->resident,
                'amount' => $request->amount,
                'code_operation' => $request->code_operation,
                'date_operation' => $request->date_operation,
                'payment_method' => $request->payment_method,
                'payment_document' => $fileName ?? null,
            ]);
           
       
        
        return $this->responseStatus('Fee Updated Successfully', new FeeResource($fee), 'success', 201);
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fee =Fee::find($id);
        if(!$fee){
            return $this->responseStatus('Fee Not Found', '', 'Error', 404); 
        }
        if($fee->delete()){
            File::delete(public_path() . '/upload/fees/' . $fee->payment_document);
        }
        return $this->responseStatus('Fee Deleted Success', '', '',  200);
    }
}

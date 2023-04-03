<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Resident;
use App\Traits\apiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\ResidentResource;
use Illuminate\Support\Facades\Validator;

class ResidentController extends Controller
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
            $residents = Resident::paginate(10);
            return $this->responseStatus('Get All Residents', [
                'data' => ResidentResource::collection($residents),
                'link' => ResidentResource::collection($residents)->response()->getData()->links,
                'meta' => ResidentResource::collection($residents)->response()->getData()->meta,
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
            'syndicate_id' => 'required|exists:syndicates,id',
            'name' => 'required',
            'cin' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'role' => 'required|in:resident,president,vise_president]',
        ]);

        if($validator->fails()){
            return $this->responseStatus('Resident Create Validation Error', $validator->messages(), 'error', 401);
        }
        DB::beginTransaction();
        $resident = Resident::create([
            'syndicate_id' => $request->syndicate_id,
            'name' => $request->name,
            'cin' => $request->cin,
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => $request->role,
        ]);
         DB::commit();
        
        return $this->responseStatus('Resident Create Success', new ResidentResource($resident), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $resident = Resident::find($id);
        if(!$resident){
            return $this->responseStatus('Resident Not Found', '', 'error', 404);
        }
        $resident = Resident::find($id);
        return $this->responseStatus('Resident detail', new ResidentResource($resident), 'success', 201);
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
        $resident = Resident::find($id);
        if(!$resident){
            return $this->responseStatus('Resident Not Found','', 'error', 404);

        }
        $validator = Validator::make($request->all(), [
            'syndicate_id' => 'required|exists:syndicates,id',
            'name' => 'required',
            'cin' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'role' => 'required|in:resident,president,vise_president]',
        ]);

        if($validator->fails()){
            return $this->responseStatus('Resident Update Validation Error', $validator->messages(), 'error', 401);
        }
        DB::beginTransaction();
        $resident->update([
            'syndicate_id' => $request->syndicate_id,
            'name' => $request->name,
            'cin' => $request->cin,
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => $request->role,
        ]);
         DB::commit();
         $res = Resident::find($id);
        return $this->responseStatus('Resident Updated Success', new ResidentResource($res), 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resident = Resident::find($id);
        if(!$resident){
            return $this->responseStatus('Resident Not Found', '', 'error', 404); 
        }
        $resident->delete();
        return $this->responseStatus('resident Deleted Success', '', '',  200);
    }
}

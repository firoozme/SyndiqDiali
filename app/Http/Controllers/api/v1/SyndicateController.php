<?php

namespace App\Http\Controllers\api\v1;

use App\Traits\apiTrait;
use App\Models\Syndicate;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\SyndicateResource;
use Illuminate\Support\Facades\Validator;

class SyndicateController extends Controller
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
            $syndicates = Syndicate::paginate(10);
            return $this->responseStatus('Get All Syndicates', [
                'data' => SyndicateResource::collection($syndicates),
                'link' => SyndicateResource::collection($syndicates)->response()->getData()->links,
                'meta' => SyndicateResource::collection($syndicates)->response()->getData()->meta,
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
            'name' => ['required',Rule::unique('syndicates')->whereNull('deleted_at')],
            'arabic_name' => 'required',
            'creation_date' => 'required|date',
            'starting_date' => 'required|date',
        ]);

        if($validator->fails()){
            return $this->responseStatus('Syndicate Create Validation Error', $validator->messages(), 'error', 401);
        }
        DB::beginTransaction();
        $syndicate = Syndicate::create([
            'name' => $request->name,
            'syndicate_name_arabic' => $request->arabic_name,
            'syndicate_creation_date' => $request->creation_date,
            'syndicate_starting_date' => $request->starting_date,
        ]);
         DB::commit();
        
        return $this->responseStatus('Syndicate Create Success', new SyndicateResource($syndicate), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $syndicate = Syndicate::find($id);
        if(!$syndicate){
            return $this->responseStatus('Syndicate Not Found', '', 'error', 404);
        }
        $syndicate = Syndicate::find($id);
        return $this->responseStatus('Syndicate detail', new SyndicateResource($syndicate), 'success', 201);
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
        $syndicate = Syndicate::find($id);
        if(!$syndicate){
            return $this->responseStatus('Syndicate Not Found', '', 'error', 404);
        }
        $validator = Validator::make($request->all(), [
            'name' => ['required', Rule::unique('syndicates')->whereNull('deleted_at')->ignore($id)],
            'arabic_name' => 'required',
            'creation_date' => 'required|date',
            'starting_date' => 'required|date',
        ]);

        if($validator->fails()){
            return $this->responseStatus('Syndicate Update Validation Error', $validator->messages(), 'error', 401);
        }
        
        $syndicate->update([
            'name'=>$request->name,
            'syndicate_name_arabic' => $request->arabic_name,
            'syndicate_creation_date' => $request->creation_date,
            'syndicate_starting_date' => $request->starting_date,

        ]);
        
        return $this->responseStatus('Syndicate Updated Successfully', new SyndicateResource($syndicate), 'success', 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $syndicate = Syndicate::find($id);
        if(!$syndicate){
            return $this->responseStatus('Syndicate Not Found', '', 'error', 404); 
        }
        $syndicate->delete();
        return $this->responseStatus('Syndicate Deleted Success', '', '',  200);
    }
}

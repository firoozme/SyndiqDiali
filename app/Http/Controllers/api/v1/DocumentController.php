<?php

namespace App\Http\Controllers\api\v1;

use Carbon\Carbon;
use App\Models\Document;
use App\Traits\apiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Resources\DocumentResource;
use Illuminate\Support\Facades\Validator;

class DocumentController extends Controller
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
            $documents = Document::paginate(10); 
            return $this->responseStatus('Get All Documents', [
                'data' => DocumentResource::collection($documents),
                'link' => DocumentResource::collection($documents)->response()->getData()->links,
                'meta' => DocumentResource::collection($documents)->response()->getData()->meta,
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
            'file' => 'required|mimes:jpeg,jpg,png,pdf',
        ]);

        if($validator->fails()){
            return $this->responseStatus('Document Create Validation Error', $validator->messages(), 'error', 401);
        }
        DB::beginTransaction();

                $file = $request->file;
                $fileName = 'document_' . Carbon::now()->microsecond . '.' . $file->extension();
                $path = $file->storeAs('/upload/documents/', $fileName, 'my_files');

            $fee = Document::create([
                'syndicate_id' => $request->syndicate_id,
                'name' => $request->name,
                "url" => $fileName ?? null,
            ]);
        
         DB::commit();
        
        return $this->responseStatus('Document Create Success', new DocumentResource($fee), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $document = Document::find($id);
        if(!$document){
            return $this->responseStatus('Document Not Found', '', 'error', 404);
        }
        return $this->responseStatus('Document detail', new DocumentResource($document), 'success', 201);
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
        $doc = Document::find($id);
        if(!$doc){
            return $this->responseStatus('Document Not Found', '', 'error', 404);
        }
        $validator = Validator::make($request->all(), [
            'syndicate_id' => 'required|exists:syndicates,id',
            'name' => 'required',
            'file' => 'nullable|mimes:jpeg,jpg,png,pdf',
        ]);

        if($validator->fails()){
            return $this->responseStatus('Document Update Validation Error', $validator->messages(), 'error', 401);
        }
        
            $fileName = $doc->url;
            if ($request->file) {
                $file = $request->file;
                File::delete(public_path() . '/upload/documents/' . $fileName);
                $fileName = 'document_' . Carbon::now()->microsecond . '.' . $file->extension();
                $path = $file->storeAs('/upload/documents/', $fileName, 'my_files');
            }
            $doc->update([
                'syndicate_id' => $request->syndicate_id,
                'name' => $request->name,
                'url' => $fileName ?? null,
            ]);
           
       
        
        return $this->responseStatus('Document Updated Successfully', new DocumentResource($doc), 'success', 201);
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $document =Document::find($id);
        if(!$document){
            return $this->responseStatus('Document Not Found', '', 'Error', 404); 
        }
        if($document->delete()){
            File::delete(public_path() . '/upload/documents/' . $document->url);
        }
        return $this->responseStatus('Document Deleted Success', '', '',  200);
    }
}

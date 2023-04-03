<?php

namespace App\Http\Controllers\api\v1;

use App\Traits\apiTrait;
use App\Models\BankAccount;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\bankAccountResource;

class bankAccountController extends Controller
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
            $bankAccounts = BankAccount::latest()->paginate(10); 
            return $this->responseStatus('Get All Bank Accounts', [
                'data' => bankAccountResource::collection($bankAccounts),
                'link' => bankAccountResource::collection($bankAccounts)->response()->getData()->links,
                'meta' => bankAccountResource::collection($bankAccounts)->response()->getData()->meta,
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
            'name' => 'required|unique:bank_accounts,name',
            'iban' => 'required',
            'rib' => 'required',
            'bic' => 'required',
            'syndicate' => 'required|exists:syndicates,id',
        ]);

        if($validator->fails()){
            return $this->responseStatus('Bank Account Create Validation Error', $validator->messages(), 'error', 401);
        }
        DB::beginTransaction();
        $user = bankAccount::create([
            'name' => $request->name,
            'iban' => $request->iban,
            'rib' => $request->rib,
            'bic' => $request->bic,
            'syndicate_id' => $request->syndicate,
        ]);
         DB::commit();
        
        return $this->responseStatus('Bank Account Create Success', new bankAccountResource($user), 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bankAccount = bankAccount::find($id);
        if(!$bankAccount){
            return $this->responseStatus('Bank Account Not Found', '', 'error', 404);
        }
        return $this->responseStatus('Bank Account detail', new bankAccountResource($bankAccount), 'success', 201);
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
        $bankAccount = BankAccount::find($id);
        if(!$bankAccount){
            return $this->responseStatus('Bank Account Not Found', '', 'error', 404);
        }
        $validator = Validator::make($request->all(), [
            'name' => ['required', Rule::unique('bank_accounts')->whereNull('deleted_at')->ignore($bankAccount->id)],
            'iban' => 'required',
            'rib' => 'required',
            'bic' => 'required',
            'syndicate' => 'required|exists:syndicates,id',
        ]);

        if($validator->fails()){
            return $this->responseStatus('Bank Account Update Validation Error', $validator->messages(), 'error', 401);
        }
        
        $bankAccount->update([
            'syndicate_id' => $request->syndicate,
                'name' => $request->name,
                'iban' => $request->iban,
                'rib' => $request->rib,
                'bic' => $request->bic,
        ]);
        
        return $this->responseStatus('Bank Account Updated Successfully', new bankAccountResource($bankAccount), 'success', 201);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $bankAccount =bankAccount::find($id);
        if(!$bankAccount){
            return $this->responseStatus('Bank Account Not Found', '', 'Error', 404); 
        }
        $bankAccount->delete();
        return $this->responseStatus('Bank Account Deleted Success', '', '',  200);
        
    }
}

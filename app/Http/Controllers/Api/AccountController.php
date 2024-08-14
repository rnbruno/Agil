<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use App\Http\Requests\AccountRequest;
use App\Http\Resources\AccountResource;

class AccountController extends Controller
{
    public function index()
    {
        return AccountResource::collection(Account::all());
    }
 
    public function store(AccountRequest $request)
    {
        $account = Account::create($request->validated());
 
        return new AccountResource($account);
    }
 
    public function show($id_int)
    {
        $account = Account::getAccountUsers($id_int);
        if ($account) {
            return response()->json($account);
        } else {
            return response()->json(['error' => 'Transfer not found']);
        }
    }
 
    public function update(AccountRequest $request, Account $account)
    {
        $account->update($request->validated());
 
        return new AccountResource($account);
    }
 
    public function destroy(Account $account)
    {
        $account->delete();
 
        return response()->noContent();
    }
}

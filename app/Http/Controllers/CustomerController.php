<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Customer;
use Inertia\Inertia;

class CustomerController extends Controller
{
    //
    public function index(){
        return Inertia::render('index',[
            'customers'=>Customer::all()->map(function($customer){
                return [
                    'id'=> $customer->id,
                    'name'=>$customer->name
                ];
            })
        ]);
    }
    public function create(){
        return Inertia::render('Profile/Form');
    }
    public function store(Request $request){
        $validated = $request->validate([
            'name'=>'required|max:255',
            'email'=>'required|email|unique:customers',
            'phone'=>'required|unique:customers|max:14|min:10',
        ]);

        Customer::create($validated);
        return Redirect::route('customers.index');
    }
}

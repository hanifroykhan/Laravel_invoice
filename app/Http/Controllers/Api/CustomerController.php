<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;


class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('created_at', 'DESC')->paginate(10);
        return [
            "status" => 1,
            "data" => $customers
        ];
    }

    public function show(Customer $customer)
    {
        return [
            "status" => 1,
            "data" => $customer
        ];
    }
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'subject' => 'required'
        ]);

        $customer = Customer::create($request->all());
        return [
            "status" => 1,
            "data" => $customer,
            "message" => "data created successfully"
        ];
    }


    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'subject' => 'required'
        ]);

        
        $customer->update($request->all());
        return [
            "status" => 1,
            "data" => $customer,
            "message" => "data updated succesfully"
        ];
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return [
            "status" => 1,
            "data" => $customer,
            "message" => "data deleted successfully"
        ];
    }
}

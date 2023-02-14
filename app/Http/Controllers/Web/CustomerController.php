<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;


class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('created_at', 'DESC')->paginate(10);
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'subject' => 'required'
        ]);

        $post = new Customer();
        $post->name = $request->input('name');
        $post->address = $request->input('address');
        $post->subject = $request->input('subject');
        $post->save();

        return redirect('/indexCustomers')->with('success', 'Data Customer created successfully!');;
    }

    public function edit($id)
    {
        $editCustomer = Customer::find($id);
        return view('customers.edit', compact('editCustomer'));
    }

    public function update(Request $request, $id)
    {
        $editCustomer = Customer::find($id);
        $editCustomer->name = $request->input('name');
        $editCustomer->address = $request->input('address');
        $editCustomer->subject = $request->input('subject');
        $editCustomer->update();
        return redirect('/indexCustomers')->with('status','Data Customer Updated Successfully');
    }

    public function destroy($id)
    {
        DB::table('customers')->where('id', $id)->delete();
        return redirect('/indexCustomers')->with('status', 'Data Customer Berhasil DiHapus');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Storage;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5|max:200',
        ]);
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->dui = $request->dui;
        $customer->nit = $request->nit;
        $customer->nrc = $request->nrc;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->email = $request->email;
        $customer->save();
        return redirect()->route('customers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('customers.edit',compact('customer'));
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
        $request->validate([
            'name' => 'required|min:5|max:200',
        ]);
        $customer = Customer::find($id);
        $customer->name = $request->name;
        $customer->dui = $request->dui;
        $customer->nit = $request->nit;
        $customer->nrc = $request->nrc;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->email = $request->email;
        $customer->save();
        return redirect()->route('customers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return redirect()->route('customers.index')->with("success","Registro eliminado exitosamente");
    }

    public function alta()
    {
        //
    }
}

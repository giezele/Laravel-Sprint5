<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    if(isset($request->country_id) && $request->country_id !== 0)
        $customers = \App\Models\Customer::where('country_id', $request->country_id)->orderBy('surname')->get();
    
    else
        $customers = \App\Models\Customer::orderBy('surname')->get();
        $countries = \App\Models\Country::orderBy('title')->get();


    return view('customers.index', ['customers' => $customers, 'countries' => $countries])
            ->with('i', (request()->input('page', 1) - 1) *5);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = \App\Models\Country::orderBy('title')->get();
        return view('customers.create', ['countries' => $countries]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            // [Dėmesio] validacijoje unique turi būti nurodytas teisingas lentelės pavadinimas ir laukai!
               'name' => 'required', //ar tikrai reikia buti unique?
               'surname' => 'required',
               'email' => 'required',
               'phone' => 'required',
           ]);

        $customer = new Customer();
        // can be used for seeing the insides of the incoming request
        // dd($request->all());;
        $customer->fill($request->all());
        // $customer->save();
        // return redirect()->route('customers.index');

        return ($customer->save() !== 1) ? 
        redirect()->route('customers.index')->with('status_success', 'Customer created!') : 
        redirect()->route('customers.index')->with('status_error', 'Customer was not created!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $countries = \App\Models\Country::orderBy('title')->get();
        return view('customers.edit', ['customer' => $customer, 'countries' => $countries]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $this->validate($request, [
            // [Dėmesio] validacijoje unique turi būti nurodytas teisingas lentelės pavadinimas ir laukai!
               'name' => 'required', //ar tikrai reikia buti unique?
               'surname' => 'required',
               'email' => 'required',
               'phone' => 'required',
           ]);

        $customer->fill($request->all());
        // $customer->save();
        // return redirect()->route('customers.index');

        return ($customer->save() !== 1) ? 
        redirect()->route('customers.index')->with('status_success', 'Customer updated!') : 
        redirect()->route('customers.index')->with('status_error', 'Customer was not updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index', ['country_id'=> $request->input('country_id')])->with('status_success', 'Customer deleted!');;

    }

    //kliento keliones detales rodo kokie miestai konkreciam klientui p/l id - custom view
    public function travel($id){
        $customer = Customer::find($id);
        return view('customers.travel', ['customer' => $customer]);
    }

}

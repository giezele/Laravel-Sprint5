<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('countries.index', ['countries' => Country::orderBy('title')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('countries.create');
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
               'title' => 'required|unique:countries',
               'description' => 'required',
               'distance' => 'required',
           ]);

        $country = new Country();
        // can be used for seeing the insides of the incoming request
            // dd($request->all()); die();
           $country->fill($request->all());
        //    $country->save();
        //    return redirect()->route('country.index');

           return ($country->save() !== 1) ? 
           redirect()->route('country.index')->with('status_success', 'Country created!') : 
           redirect()->route('country.index')->with('status_error', 'Country was not created!');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        return view('countries.edit', ['country' => $country]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        $this->validate($request, [
            // [Dėmesio] validacijoje unique turi būti nurodytas teisingas lentelės pavadinimas ir laukai!
               'title' => 'required',
               'description' => 'required',
               'distance' => 'required',
           ]);

        $country->fill($request->all());
        // $country->save();
        // return redirect()->route('country.index');

        return ($country->save() !== 1) ? 
           redirect()->route('country.index')->with('status_success', 'Country updated!') : 
           redirect()->route('country.index')->with('status_error', 'Country was not updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        if (count($country->towns)){ 
            return back()->withErrors(['error' => ['Can\'t delete country with cities assigned, please unassign cities first!']]);
        }
        else if (count($country->customers)){ 
            return back()->withErrors(['error' => ['Can\'t delete country with customers assigned, please unassign customers first!']]);
        }

        $country->delete();
        return redirect()->route('country.index')->with('status_success', 'Country deleted!');

    }
}

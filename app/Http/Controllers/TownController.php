<?php

namespace App\Http\Controllers;

use App\Models\Town;
use Illuminate\Http\Request;

class TownController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //JEI BE FILTRO SITAS INDEX
    public function index()
    {
        return view('towns.index', ['towns' => Town::orderBy('title')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = \App\Models\Country::orderBy('title')->get();
        return view('towns.create', ['countries' => $countries]);

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
               'title' => 'required|unique:towns', //ar tikrai reikia buti unique?
               'population' => 'required',
               'country_id' => 'required',
           ]);

        $town = new Town();
        // can be used for seeing the insides of the incoming request
        // var_dump($request->all()); die();
        $town->fill($request->all());
        // $town->save();
        // return redirect()->route('town.index');

        return ($town->save() !== 1) ? 
        redirect()->route('town.index')->with('status_success', 'Town created!') : 
        redirect()->route('town.index')->with('status_error', 'Town was not created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Town  $town
     * @return \Illuminate\Http\Response
     */
    public function show(Town $town)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Town  $town
     * @return \Illuminate\Http\Response
     */
    public function edit(Town $town)
    {
         // ATTENTION :: we need countries to be able to assign them
         $countries = \App\Models\Country::orderBy('title')->get();
         return view('towns.edit', ['town' => $town, 'countries' => $countries]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Town  $town
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Town $town)
    {
        $this->validate($request, [
            // [Dėmesio] validacijoje unique turi būti nurodytas teisingas lentelės pavadinimas!
               'title' => 'required',
               'population' => 'required',
               'country_id' => 'required',
           ]);

        $town->fill($request->all());
        // $town->save();
        // return redirect()->route('town.index');

        return ($town->save() !== 1) ? 
        redirect()->route('town.index')->with('status_success', 'Town updated!') : 
        redirect()->route('town.index')->with('status_error', 'Town was not updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Town  $town
     * @return \Illuminate\Http\Response
     */
    public function destroy(Town $town)
    {
        $town->delete();
        return redirect()->route('town.index')->with('status_success', 'Town deleted!');
    }
}

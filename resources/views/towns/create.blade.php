@extends('layouts.app')
@section('content')

    {{-- DB klaidu logika --}}    {{-- Database error/success display logic --}}
    @if (session('status_success'))
    <p style="color: green"><b>{{ session('status_success') }}</b></p>
    @else
    <p style="color: red"><b>{{ session('status_error') }}</b></p>
    @endif


    @if ($errors->any())
    <div>
        @foreach ($errors->all() as $error)
            <p style="color: red">{{ $error }}</p>
        @endforeach
    </div>
    @endif 
 
 <div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Sukurkime miestą:</div>
               <div class="card-body">
                   <form action="{{ route('town.store') }}" method="POST">
                       @csrf
                       @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                       <div class="form-group">
                            <label for="">Pavadinimas: </label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Gyventojų skaičius: </label>
                            <input type="number" name="population" class="form-control">
                        </div>
                       <div class="form-group">
                           <label>Šalis: </label>
                           <select name="country_id" id="" class="form-control">
                                <option value="" selected disabled>Pasirinkite šalį</option>
                                @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->title }}</option>
                                @endforeach
                           </select>
                       </div>
                       <button type="submit" class="btn btn-primary">Submit</button>
                   </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
 

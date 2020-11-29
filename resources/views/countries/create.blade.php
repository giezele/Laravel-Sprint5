@extends('layouts.app')
@section('content')

    {{-- DB klaidu logika --}}    {{-- Database error/success display logic --}}
    @if (session('status_success'))
    <p style="color: green"><b>{{ session('status_success') }}</b></p>
    @else
    <p style="color: red"><b>{{ session('status_error') }}</b></p>
    @endif


    {{-- Validacijos klaidu logika --}}    {{-- Validation error, for invalid incoming data display logic --}}
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
               <div class="card-header">Sukurkime šalį:</div>
               <div class="card-body">
                   <form action="{{ route('country.store') }}" method="POST">
                       @csrf
                       @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                       <div class="form-group">
                           <label>Pavadinimas: </label>
                           <input type="text" name="title" class="form-control">
                       </div>
                       <div class="form-group">
                           <label>Atstumas: </label>
                           <input type="number" name="distance" class="form-control"> 
                       </div>
                       <div class="form-group">
                           <label>Aprašymas: </label>
                           <textarea id="mce" name="description" rows=10 cols=100 class="form-control"></textarea>
                       </div>
                       <button type="submit" class="btn btn-primary">Submit</button>
                   </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection

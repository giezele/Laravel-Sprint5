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
                <div class="card-header">Pakeiskime šalies informaciją</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('country.update', $country->id) }}">
                        @csrf @method("PUT")
                        <div class="form-group">
                            <label for="">Pavadinimas</label>
                            <input type="text" name="title" class="form-control" value="{{ $country->title }}">
                        </div>
                        <div class="form-group">
                            <label for="">Atstumas</label>
                            <input type="text" name="distance" class="form-control" value="{{ $country->distance }}">
                        </div>
                        <div class="form-group">
                            <label for="">Aprašas</label>
                            <textarea id="mce" type="text" name="description" rows=10 cols=100 class="form-control">{{ $country->description }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Pakeisti</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

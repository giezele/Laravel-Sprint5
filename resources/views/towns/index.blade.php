@extends('layouts.app')
@section('content')


    {{-- DB klaidu logika --}}    {{-- Database error/success display logic --}}
    @if (session('status_success'))
    <p style="color: green"><b>{{ session('status_success') }}</b></p>
    @else
    <p style="color: red"><b>{{ session('status_error') }}</b></p>
    @endif

    @if($errors->any())
    <h4 style="color: red">{{$errors->first()}}</h4>
    @endif


 <div class="card">
   
     <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Pavadinimas</th>
                    <th>Populiacija</th>
                    <th>Šalis</th>
                    <th>Veiksmai</th>
                </tr>
            </thead>
            @foreach ($towns as $town)
            <tr>
                <td>{{ $town->title }}</td>
                <td>{{ $town->population }}</td>
                <td>{{ $town->country->title }}</td>
                <td>
                    <form action={{ route('town.destroy', $town->id) }} method="POST">
                        <a class="btn btn-success" href={{ route('town.edit', $town->id) }}>Redaguoti</a>
                        @csrf @method('delete')
                        <input type="submit" class="btn btn-danger" value="Trinti"/>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        <div>
            <a href="{{ route('town.create') }}" class="btn btn-success">Pridėti</a>
        </div>
    </div>
 </div>
@endsection
 

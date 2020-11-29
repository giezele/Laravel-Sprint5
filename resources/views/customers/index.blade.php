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

 <div class="card">
         {{-- filtras  --}}
    <div class="card-header ">
        <div class="mr-auto pull-left">
            <form class="form-inline" action="{{ route('customers.index') }}" method="GET">
                <select name="country_id" id="" class="form-control">
                    <option value="" selected disabled>Pasirinkite šalį klientų filtravimui:</option>
                    @foreach ($countries as $country)
                    <option value="{{ $country->id }}" 
                        @if($country->id == app('request')->input('country_id')) 
                            selected="selected" 
                        @endif>
                        {{ $country->title }}
                    </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Pasirinkti</button>
            </form>
        </div>


    </div>

 <div class="card-body">
    @if($errors->any())
    <h4 style="color: red">{{$errors->first()}}</h4>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Vardas</th>
                <th>Pavardė</th>
                <th>Email</th>
                <th>Telefonas</th>
                <th>Šalis</th>
                <th>Veiksmai</th>
            </tr>
        </thead>
        @foreach ($customers as $customer)
        <tr>
            <td>{{ $customer->name }}</td>
            <td>{{ $customer->surname }}</td>
            <td>{{ $customer->email }}</td>
            <td>{{ $customer->phone }}</td>
            <td>{{ $customer->country->title }}</td>
            <td>
                <form action={{ route('customers.destroy', $customer->id) }} method="POST">
                    <a class="btn btn-success" href={{ route('customers.edit', $customer->id) }}>Redaguoti</a>
                    @csrf @method('delete')
                    <input type="submit" class="btn btn-danger" value="Trinti"/>
                    <a href="{{ route('customers.travel', $customer->id) }}" class="btn btn-primary m-1">Peržiūrėti kelionę</a>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <div>
        <a href="{{ route('customers.create') }}" class="btn btn-success">Pridėti</a>
    </div>
 </div>
</div>
@endsection

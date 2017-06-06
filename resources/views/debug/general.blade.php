@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="col-md-3">
            <h1>Users</h1>
            @foreach($users as $key => $user)
                <h2>{{ $key }}</h2>
                <p>First name: {{ $user->first_name }}</p>
                <p>Middle name: {{ $user->middle_name }}</p>
                <p>Last name: {{ $user->last_name }}</p>
                <p>Email name: {{ $user->email }}</p>
                <p>Is Active: {{ $user->active ? 'true' : 'false' }}</p>
                <br>
            @endforeach
        </div>

        <div class="col-md-3">
            <h1>Companies</h1>
            @foreach($companies as $key => $company)
                <h2>{{ $key }}</h2>
                <p>ID: {{ $company->id }}</p>
                <p>Name: {{ $company->name }}</p>
                <p>Addr: {{ $company->address }}</p>
                <p>City: {{ $company->city }}</p>
                <p>Postcode: {{ $company->postcode }}</p>
                <p>Country: {{ $company->country }}</p>
                <br>
            @endforeach
        </div>

        <div class="col-md-3">
            <h1>Products</h1>
            @foreach($products as $key => $product)
                <h2>{{ $key }}</h2>
                <p>Product ID: {{ $product->id }}</p>
                <p>Product name: {{ $product->name }}</p>
                <p>Quantity: {{ $product->quantity }}</p>
                <p>Description: {{ $product->description }}</p>
                <p>Barcode: {{ $product->barcode }}</p>
                <p>Unit price: {{ $product->unit_price }}</p>
                <p>Company name: {{ $product->company_name }}</p>
                <p>Company id: {{ $product->company_id }}</p>
                <br>
            @endforeach
        </div>

        <div class="col-md-3">
            <h1>Shipping methods</h1>
            @foreach($sms as $key => $sm)
                <h2>{{ $key }}</h2>
                {{ $sm }}
                <br>
            @endforeach
        </div>
    </div>
@endsection
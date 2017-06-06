@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <h1>Invoices</h1>
            @foreach($invoices as $key => $invoice)
                <h2>{{ $key }}</h2>
                <pre>
                    {{ json_encode($invoice, JSON_PRETTY_PRINT) }}
                </pre>
                <br>
            @endforeach
        </div>
    </div>
@endsection
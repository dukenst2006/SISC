@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <strong>Your company</strong>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="col-xs-12">
                            @include('fragments.customer_info', ['customer' => $company])
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Customer information</strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-xs-12">
                            @if(isset($customer))
                                <div class="text-right pull-right">
                                    @include('fragments.customer_info', ['customer' => $customer])
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <form id="cart-form" class="form-horizontal" role="form" method="POST">

                    {{ csrf_field() }}

                    @include('invoice.additional_info')
                    @include('fragments.invoice_items')

                </form>

                {{-- BUTTONS --}}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Actions</strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="btn-toolbar">
                                    <a class="btn btn-danger" href="{{ route('cart-destroy') }}">
                                        Reset
                                    </a>

                                    <a class="btn btn-warning pull-right"
                                            onclick="event.preventDefault();
                                            document.getElementById('cart-form').action = '{{ route('cart-update') }}';
                                            document.getElementById('cart-form').submit();">
                                        Update
                                    </a>

                                    <button class="btn btn-primary pull-right" {{ $disable_creation ? 'disabled' : '' }}
                                            onclick="event.preventDefault();
                                            document.getElementById('cart-form').action = '{{ route('cart-finalize') }}';
                                            document.getElementById('cart-form').submit();">
                                        Create invoice
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

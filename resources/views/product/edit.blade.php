@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">

            {{-- PRODUCT INFO --}}
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Product information</div>
                    <div class="panel-body">

                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ route('product-update') }}" autocomplete="on">

                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}

                            <input type="hidden" name="id" value="{{ $product['id'] }}"/>

                            <div class="form-group form-group-wlabel">
                                <div class="col-md-6{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" value="{{ $product['name'] }}" name="name">
                                    
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                    @endif
                                </div>

                                <div class="col-md-6{{ $errors->has('barcode') ? ' has-error' : '' }}">
                                    <label for="barcode">Barcode</label>
                                    <input type="text" class="form-control" id="barcode" value="{{ $product['barcode'] }}" name="barcode">

                                    @if ($errors->has('barcode'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('barcode') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group form-group-wlabel">
                                <div class="col-md-6{{ $errors->has('quantity') ? ' has-error' : '' }}">
                                    <label for="quantity">Quantity</label>
                                    <input type="text" class="form-control" id="quantity" value="{{ $product['quantity'] }}" name="quantity">

                                    @if ($errors->has('quantity'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('quantity') }}</strong>
                                            </span>
                                    @endif
                                </div>

                                <div class="col-md-6{{ $errors->has('unit_price') ? ' has-error' : '' }}">
                                    <label for="unit_price">Unit price (in cents)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">£</span>
                                        <input type="text" class="form-control" id="unit_price" value="{{ $product['unit_price'] }}" name="unit_price">
                                    </div>

                                    @if ($errors->has('unit_price'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('unit_price') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group form-group-wlabel">
                                <div class="col-md-12{{ $errors->has('description') ? ' has-error' : '' }}">
                                    <label for="description">Description</label>
                                    <textarea name="description" class="form-control" rows="5" id="description">{{ $product['description'] }}</textarea>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group form-group-wlabel">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary pull-right">Update</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- /PRODUCT INFO --}}

@endsection
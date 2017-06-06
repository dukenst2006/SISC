@extends('layouts.app')

<style type="text/css">
    .glyphicon { margin-right:5px; }
    .thumbnail
    {
        margin-bottom: 20px;
        padding: 0px;
        -webkit-border-radius: 0px;
        -moz-border-radius: 0px;
        border-radius: 0px;
    }

    .item.list-group-item
    {
        float: none;
        width: 100%;
        background-color: #fff;
        margin-bottom: 10px;
    }
    .item.list-group-item:nth-of-type(odd):hover,
    .item.list-group-item:hover
    {
        background: white;
    }

    .item.list-group-item .list-group-image
    {
        margin-right: 10px;
    }
    .item.list-group-item .thumbnail
    {
        margin-bottom: 0;
    }
    .item.list-group-item .caption
    {
        padding: 9px 9px 0 9px;
    }
    .item.list-group-item:nth-of-type(odd)
    {
        background: #eeeeee;
    }

    .item.list-group-item:before, .item.list-group-item:after
    {
        display: table;
        content: " ";
    }

    .item.list-group-item img
    {
        float: left;
    }
    .item.list-group-item:after
    {
        clear: both;
    }
    .list-group-item-text
    {
        margin: 0 0 11px;
    }
</style>

@section('content')

    <div class="container">
        <div class="well well-sm">
            <strong>Products display </strong>
            <div class="btn-group">
                <a href="#" id="grid" class="btn btn-default btn-sm">
                    <span class="glyphicon glyphicon-th"></span>Grid
                </a>

                <a href="#" id="list" class="btn btn-default btn-sm">
                    <span class="glyphicon glyphicon-th-list"></span>List
                </a>
            </div>
        </div>
        <div id="products" class="row list-group">

            @foreach($model as $product)
                <div id="product-{{ $product->id }}" class="item col-xs-4 col-lg-4 grid-group-item">
                    <div class="thumbnail">
                        <img class="group list-group-image" src="/images/placeholder.png" alt="" />
                        <div class="caption">
                            <h4 class="group inner list-group-item-heading padding-bottom-10">{{ ucfirst($product->name) }}</h4>
                            {{--<h5 class="group inner list-group-item-heading padding-bottom-10">{{ $product->company_name }}</h5>--}}
                            <p class="group inner list-group-item-text">{{ str_limit($product->description, 70) }}</p>
                            <br/>
                            <div class="row">
                                <div class="col-xs-12">
                                    <p class="lead pull-left">Stock: {{ $product->quantity }}</p>
                                    <p class="lead pull-right">£ {{ number_format($product->unit_price / 100, 2)  }}</p>
                                </div>
                                <div class="col-xs-12">
                                    <a class="btn btn-default pull-left" href="{{ route('product-edit', $product->id) }}">Edit product</a>

                                    <a id="add-product-{{ $product->id }}" class="btn{{ $product->needsReorder() ? ' btn-warning' : ' btn-success' }} pull-right"
                                       href="{{ route('cart-add', [$product->id, 1]) }}">Add to invoice</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        {{ $model->links() }}
    </div>


@endsection
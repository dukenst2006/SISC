<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><strong>Order summary</strong></h3>
    </div>

    <div class="panel-body">
        <div class="table-responsive">

            <table class="table table-striped">
                <thead>
                <tr>
                    <td id="invoice-id" class="col-xs-1"><strong>ID</strong></td>
                    <td id="invoice-name" class="col-xs-4"><strong>Product name</strong></td>
                    <td id="invoice-unit_price" class="col-xs-2 text-center"><strong>Unit price</strong></td>
                    <td id="invoice-quantity" class="col-xs-2 text-center"><strong>Quantity</strong></td>
                    <td id="invoice-totals" class="col-xs-2 text-right"><strong>Totals</strong></td>
                    <td class="col-xs-1 pull-right"></td>
                </tr>
                </thead>
                <tbody>

                @foreach($products as $product)
                    <tr class="invoice-row">
                        <td>
                            {{ $product->id }}
                            <input type="hidden" name="products[{{$product->id}}][id]"
                                   value="{{ $product->id }}"/>
                        </td>

                        <td>{{ $product->name }}</td>

                        <td class="text-center">£ {{ $product->unit_price }}</td>

                        <td class="text-center">
                                @if(!isset($invoice))
                                <input type="number" class="form-control"
                                       name="products[{{$product->id}}][quantity]"
                                       title="Product quantity" value="{{ $product->qty }}"
                                       min="0" step="1"/>
                            @else
                                    {{ $product->qty }}
                            @endif
                        </td>

                        <td class="text-right">£ {{ $product->total_price }}</td>

                        <td class="text-right">
                            <a href="{{ route('cart-remove', $product->id) }}"
                               aria-label="Remove product">
                                <div class="glyphicon glyphicon-remove-circle"></div>
                            </a>
                        <td>
                    </tr>
                @endforeach

                <tr>
                    <td class="thick-line"></td>
                    <td class="thick-line"></td>
                    <td class="thick-line"></td>
                    <td class="thick-line text-center"><strong>Subtotal</strong></td>
                    <td class="thick-line text-right">£ {{ $subtotal }}</td>
                </tr>
                <tr>
                    <td class="no-line"></td>
                    <td class="no-line"></td>
                    <td class="no-line"></td>
                    <td class="no-line text-center"><strong>Tax</strong></td>
                    <td class="no-line text-right">£ {{ $tax }}</td>
                </tr>
                <tr>
                    <td class="no-line"></td>
                    <td class="no-line"></td>
                    <td class="no-line"></td>
                    <td class="no-line text-center"><strong>Total</strong></td>
                    <td class="no-line text-right">£ {{ $total }}</td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
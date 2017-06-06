
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="invoice-title">
                <h2>Invoice</h2>
                <h3 class="pull-right">Order # 12345</h3>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-12">
                    <address>
                        <strong>{{ $this_company->name }}</strong><br>
                        {{ $this_company->address }}<br>
                        {{ $this_company->postcode }} - {{ $this_company->city }}, {{ $this_company->country }}<br>
                        Phone: {{ $this_company->telephone }}<br>
                        E-mail: {{ $this_company->email }}
                    </address>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-6">
                    <address>
                        <strong>{{ $billing_company->name }}</strong><br>
                        {{ $billing_company->address }}<br>
                        {{ $billing_company->postcode }} - {{ $billing_company->city }}
                        , {{ $billing_company->country }}<br>
                        Phone: {{ $billing_company->telephone }}<br>
                        E-mail: {{ $billing_company->email }}
                    </address>
                </div>
                <div class="col-xs-6 text-right">
                    <address>
                        <strong>{{ $shipping_company->name }}</strong><br>
                        {{ $shipping_company->address }}<br>
                        {{ $shipping_company->postcode }} - {{ $shipping_company->city }}
                        , {{ $shipping_company->country }}<br>
                        Phone: {{ $shipping_company->telephone }}<br>
                        E-mail: {{ $shipping_company->email }}
                    </address>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-4">
                    <address>
                        <strong>Payment Method:</strong><br>
                        Visa ending **** 4242<br>
                        jsmith@email.com
                    </address>
                </div>
                <div class="col-xs-4">
                    <strong>Salesperson:</strong><br>
                    {{ $info['created_by'] }}
                </div>
                <div class="col-xs-4 text-right">
                    <address>
                        <strong>Order Date:</strong> {{ $info['order_date'] }}<br>

                    </address>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Order summary</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <td><strong>Item</strong></td>
                                <td class="text-center"><strong>Price</strong></td>
                                <td class="text-center"><strong>Quantity</strong></td>
                                <td class="text-right"><strong>Totals</strong></td>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- foreach ($order->lineItems as $line) or some such thing here -->
                            <tr>
                                <td>BS-200</td>
                                <td class="text-center">$10.99</td>
                                <td class="text-center">1</td>
                                <td class="text-right">$10.99</td>
                            </tr>
                            <tr>
                                <td>BS-400</td>
                                <td class="text-center">$20.00</td>
                                <td class="text-center">3</td>
                                <td class="text-right">$60.00</td>
                            </tr>
                            <tr>
                                <td>BS-1000</td>
                                <td class="text-center">$600.00</td>
                                <td class="text-center">1</td>
                                <td class="text-right">$600.00</td>
                            </tr>
                            <tr>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                <td class="thick-line text-right">$670.99</td>
                            </tr>
                            <tr>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line text-center"><strong>Shipping</strong></td>
                                <td class="no-line text-right">$15</td>
                            </tr>
                            <tr>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line text-center"><strong>Total</strong></td>
                                <td class="no-line text-right">$685.99</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 0;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }
    </style>
</head>

<body>
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">

        <tr class="top">
            <td colspan="3">
                <table>
                    <tr>
                        <td align="right">
                            Invoice #: {{ $invoice->number }}<br>
                            Created: {{ date_format(date_create($invoice->date), 'M d, Y') }}<br>
                            Due: {{ date_format(date_create($invoice->due_date), 'M d, Y') }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">

            <td align="left">
                @include('fragments.company_info', ['company' => $invoice->company])
            </td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td><strong>Issued to:</strong></td>
        </tr>

        <tr class="information">
            <td></td>
            <td></td>
            <td align="right">
                @include('fragments.customer_info', ['customer' => $invoice->customer])
            </td>
        </tr>

        <tr class="heading">
            <td>
                Shipping Method
            </td>

            <td></td>

            <td align="right">
                {{ $invoice->shipping_method }}
            </td>
        </tr>

        <tr class="heading">
            <td>
                Payment Method
            </td>

            <td></td>

            <td align="right">
                {{ $invoice->payment_terms }} #
            </td>
        </tr>

        <tr class="details">
            <td>
                {{ $invoice->payment_terms }}
            </td>
            <td></td>
            <td align="right">
                £ {{ $invoice->total }}
            </td>
        </tr>

        <tr class="heading">
            <td>
                Item
            </td>

            <td>Quantity</td>

            <td align="right">
                Price
            </td>
        </tr>

        @foreach($products as $product)

            <tr class="item">
                <td>
                    {{ $product['name'] }}
                </td>

                <td>
                    {{ $product['qty'] }}
                </td>

                <td align="right">
                    £ {{ number_format(($product['price'] * $product['qty'] / 100), 2) }}
                </td>
            </tr>

        @endforeach


        <tr class="total">
            <td colspan="3">
                <table>
                    <tr>
                        <td align="right">Subtotal: £ {{ $invoice->subtotal }}</td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="total">
            <td colspan="3">
                <table>
                    <tr>
                        <td align="right">Tax: £ {{ $invoice->tax }}</td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="total">
            <td colspan="3">
                <table>
                    <tr>
                        <td align="right">Total: £ {{ $invoice->total }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
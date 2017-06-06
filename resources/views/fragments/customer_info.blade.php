<table>
    <thead></thead>
    <tbody>
        <tr><td><strong>{{ $customer->name }}</strong></td></tr>
        <tr><td>{{ $customer->address }}</td></tr>
        <tr><td>{{ $customer->postcode }} - {{ $customer->city }}, {{ $customer->country }}</td></tr>
        <tr><td>Phone: {{ $customer->telephone }}</td></tr>
        <tr><td>E-mail: {{ $customer->email }}</td></tr>
    </tbody>
</table>
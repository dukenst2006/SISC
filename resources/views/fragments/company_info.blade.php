<table>
    <thead></thead>
    <tbody>
        <tr><td><strong>{{ $company->name }}</strong></td></tr>
        <tr><td>{{ $company->address }}</td></tr>
        <tr><td>{{ $company->postcode }} - {{ $company->city }}, {{ $company->country }}</td></tr>
        <tr><td>VAT: {{ $company->vat }}</td></tr>
        <tr><td>Phone: {{ $company->telephone }}</td></tr>
        <tr><td>E-mail: {{ $company->email }}</td></tr>
    </tbody>
</table>
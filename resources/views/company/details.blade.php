@extends('../layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            {{-- COMPANY INFO --}}
            <div class="col-xs-12">

                @include('fragments.company_panel')

            </div>

        </div>
    </div>
@endsection

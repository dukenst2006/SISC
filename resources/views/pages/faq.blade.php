@extends('../layouts.app')

@section('content')
    <style>
        .faqHeader {
            font-size: 27px;
            margin: 20px;
        }

        .panel-heading [data-toggle="collapse"]:after {
            font-family: 'Glyphicons Halflings';
            content: "e072"; /* "play" icon */
            float: right;
            color: #F58723;
            font-size: 18px;
            line-height: 22px;
            /* rotate "play" icon from > (right arrow) to down arrow */
            -webkit-transform: rotate(-90deg);
            -moz-transform: rotate(-90deg);
            -ms-transform: rotate(-90deg);
            -o-transform: rotate(-90deg);
            transform: rotate(-90deg);
        }

        .panel-heading [data-toggle="collapse"].collapsed:after {
            /* rotate "play" icon from > (right arrow) to ^ (up arrow) */
            -webkit-transform: rotate(90deg);
            -moz-transform: rotate(90deg);
            -ms-transform: rotate(90deg);
            -o-transform: rotate(90deg);
            transform: rotate(90deg);
            color: #454444;
        }
    </style>

    <div class="container">

        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
            This page contains the Frequently Asked Questions (FAQ) for the <strong>Sales Invoicing &amp; Stock Control
                (SISC)</strong>
            System. These answers may help you find solutions to common problem. If you cannot find an answer to your
            question, make sure to contact us.
        </div>

        <br/>

        @foreach($faqs_array as $faqs_key => $faqs)

            <div class="panel-group" id="accordion">
                <div class="faqHeader"><h3>{{ $faqs['header'] }}</h3></div>

                @foreach($faqs as $faq_key => $faq)

                    @if(is_numeric($faq_key))
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapse-{{$faqs_key}}-{{$faq_key}}">
                                        {{ $faq['question'] }}
                                    </a>
                                </h4>
                            </div>

                            <div id="collapse-{{$faqs_key}}-{{$faq_key}}" class="panel-collapse collapse">
                                <div class="panel-body">
                                    {!! $faq['answer']  !!}
                                </div>
                            </div>
                        </div>
                    @endif

                @endforeach
            </div>

        @endforeach

    </div>

@endsection
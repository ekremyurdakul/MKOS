@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">

                    <strong style="font-size: large">Hasta :
                        {{$document->patient()->get()->first()->name . ' ' . $document->patient()->get()->first()->surname}} //
                        Açıklama : {{$document->name}} //
                        Tip : {{$document->document_type()->get()->first()->name}}</strong>
                    <strong style="font-size: large;float: right">Tarih :
                        <input type="date" style="border: none" id="date" name="date" value="{{$document->date}}"></strong>
                </div>
                <div class="panel-body">

                    @if($document->document_type()->get()->first()->id == 2)
                        <div class="row text-center">
                            <h4>Tetkik Bilgileri</h4>
                            <hr>
                            <div style="margin: 200px; margin-top: 10px">
                                <table id="table_tests" style="margin-top: 15px" class="table table-striped ">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Test</th>
                                        <th class="text-center">Sonuç</th>
                                    </tr>
                                    </thead>
                                    <tbody id="items_table">
                                    @foreach($document->tests()->get() as $test)
                                        <tr>
                                            <td>{{$test->name}}</td>
                                            <td>{{$test->result}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                        @if(count($document->content()->get()) > 0)
                            <div class="row text-center">
                                <h4>Döküman İçeriği</h4>
                                <hr>
                                @foreach($document->content()->get() as $content)

                                    <img class="col-md-6 form-group" src="{{ $content->getImageData() }}">
                                @endforeach
                            </div>

                        @endif

                </div>
            </div>
        </div>
    </div>

    <script>
        $("img").elevateZoom({
            scrollZoom : true,
            zoomWindowOffetx : -200
        });
    </script>
@endsection
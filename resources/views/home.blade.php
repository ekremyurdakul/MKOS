@extends('layouts.app')

@section('content')
    @include('search_customer')
    <div class="container">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Marmara Kliniği Otomasyon Sistemi</div>

                    <div class="panel-body">

                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                @auth
                                    <p>Hoşgeldiniz <strong>{{Auth::user()->name}}</strong>. </p>
                                    Lütfen yapmak istediğiniz, işlemi seçiniz.

                                        <div class="row text-center" style="padding-bottom: 50px ; padding-top: 25px ;padding-left: 15px; height: 100%; width: 100%;">
                                            <div class="input-group" style="height: 100%; width: 100%;" >

                                                <input style="height: 100%; width: 100%;" type="text" class="form-control" id="autocompletemain"
                                                       placeholder="Aramaya başlamak için hasta ismi veya soyismi yazınız">
                                            </div>
                                        </div>

                                        <div class="row text-center">
                                            <div class="col-md-4">
                                                <a href="/patients/new" class=" btn btn-primary" style="height: inherit;width: 80%"> Müşteri Ekle</a>
                                            </div>
                                            <div class="col-md-4">
                                                <button id="muayene" data-toggle="modal" data-target="#myModal" class=" btn btn-primary" style="height: inherit;width: 80%">Muayene Girişi</button>
                                            </div>
                                            <div class="col-md-4">
                                                <a id="tetkik" data-toggle="modal" data-target="#myModal" class=" btn btn-primary" style="height: inherit;width: 80%"> Tetkik Girişi</a>
                                            </div>
                                        </div>

                                    @else
                                        Lütfen Giriş Yapınız
                                        @endauth


                    </div>
                </div>
            </div>

        <script src="{{ asset('js/autocomplete.js') }}"></script>

        <script>
            $(document).ready(function () {
                var toggle = '';
                $('#muayene').click(function(){
                    toggle = 'M';
                });

                $('#tetkik').click(function(){
                    toggle = 'T';
                });

                $('#autocomplete').autocomplete({
                    serviceUrl: '/patients/search',
                    onSelect: function (suggestion) {
                        if(toggle === 'M'){
                            window.location.href = "{{ \Illuminate\Support\Facades\URL::to('/') }}" + "/examinations/new?patient_id=" + suggestion.data;
                        }else{
                            window.location.href = "{{ \Illuminate\Support\Facades\URL::to('/') }}" + "/documents/new?patient_id=" + suggestion.data;
                        }
                    }
                });
                $('#autocompletemain').autocomplete({
                    serviceUrl: '/patients/search',
                    onSelect: function (suggestion) {
                        window.location.href = "{{ \Illuminate\Support\Facades\URL::to('/') }}" + "/patients/card/" + suggestion.data;
                    }
                });
            });
        </script>

    </div>
@endsection

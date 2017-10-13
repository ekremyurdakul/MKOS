@extends('layouts.app')

@section('content')
    @include('search_customer')
    <div class="container">

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <form method="POST" action="/examinations/new">
                    <strong style="font-size: large">Muayene Girişi</strong>
                    <strong style="font-size: large;float: right">Tarih :
                        <input type="date" style="border: none" id="date" name="date"></strong>
                </div>

                <div class="panel-body">

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row" style="margin: 5px; border: thin; border-color: #3d6983; font-size: 12pt">
                        <strong style="font-size: 14pt; color: #222222 ">Hasta Bilgileri</strong>
                        <div style="float: right;" data-toggle="modal" data-target="#myModal"><a class="btn btn-default">
                                @if(isset($patient)) Hasta Değiştir @else Hasta Ekle @endif</a></div>
                        <hr>
                        @if(isset($patient))
                            <table>
                                <tbody>
                                <tr>
                                    <td>
                                        Hasta Adı ve Soyadı&nbsp;
                                    </td>
                                    <td>
                                        :&nbsp;&nbsp;{{$patient->name . ' ' . $patient->surname}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Cinsiyet&nbsp;
                                    </td>
                                    <td>
                                        :&nbsp;&nbsp;{{$patient->gender == 'M' ? 'Erkek' : 'Kadın'}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Doğum Tarihi&nbsp;
                                    </td>
                                    <td>
                                        :&nbsp;&nbsp;{{$patient->DOB}}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <input class="hidden" name="patient_id" value="{{$patient->id}}" required>
                        @endif
                    </div>
                            {{csrf_field()}}
                        <div class="row" style="margin: 5px;padding-top: 15px; border: thin; border-color: #3d6983; font-size: 12pt">
                            <strong style="font-size: 14pt; color: #222222">Genel Durum</strong>
                            <hr>
                                <div class="form-group col-md-4">
                                    <label for="height">Boy : </label>
                                    <input type="number" class="form-control" id="boy" name="boy">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="weight">Kilo : </label>
                                    <input type="number" class="form-control" id="kilo" name="kilo">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="bmi">BMI : </label>
                                    <input type="number" class="form-control" id="bmi" name="bmi">
                                </div>
                            <div class="form-group col-md-12">
                                <label for="sikayet">Hasta Şikayeti :  </label>
                                <textarea style="resize: none"  class="form-control" id="allergy" name="sikayet"></textarea>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="suur">Şuur : &nbsp;</label>
                                <label><input type="radio" name="suur" value="1" checked>Var</label>
                                <label><input type="radio" name="suur" value="0" >Yok</label>
                                <label><input type="radio" name="suur" value="2" >Uykuya Meyilli</label>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="kooperasyon">Kooperasyon : &nbsp;</label>
                                <label><input type="radio" name="kooperasyon" value="1" checked>Tam</label>
                                <label><input type="radio" name="kooperasyon" value="0" >Değil</label>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="deri">Deri : &nbsp;</label>
                                <label><input type="radio" name="deri" value="1" checked>Normal</label>
                                <label><input type="radio" name="deri" value="0" >Soluk</label>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="ikter">İkter : &nbsp;</label>
                                <label><input type="radio" name="ikter" value="1" >Var</label>
                                <label><input type="radio" name="ikter" value="0" checked>Yok</label>
                                <label><input type="radio" name="ikter" value="2" >Şüpheli</label>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="subikter">Subikter : &nbsp;</label>
                                <label><input type="radio" name="subikter" value="1" >Var</label>
                                <label><input type="radio" name="subikter" value="0" checked>Yok</label>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="siyanoz">Siyanoz : &nbsp;</label>
                                <label><input type="radio" name="siyanoz" value="1" >Var</label>
                                <label><input type="radio" name="siyanoz" value="0" checked>Yok</label>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="odempreb">Ödem Pretibial: &nbsp;</label>
                                <label><input type="radio" name="odempreb" value="1" >Var</label>
                                <label><input type="radio" name="odempreb" value="0" checked>Yok</label>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="odembis">Ödem Bifüssür: &nbsp;</label>
                                <label><input type="radio" name="odembis" value="1" >Var</label>
                                <label><input type="radio" name="odembis" value="0" checked>Yok</label>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="lap">LAP: &nbsp;</label>
                                <label><input type="radio" name="lap" value="1" >Var</label>
                                <label><input type="radio" name="lap" value="0" checked>Yok</label>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="turgor">Turgor  - Ton.: &nbsp;</label>
                                <label><input type="radio" name="turgor" value="1" checked>Normal</label>
                                <label><input type="radio" name="turgor" value="0" >Azalmış</label>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="tiroid">Tiroid: &nbsp;</label>
                                <label><input type="radio" name="tiroid" value="1" checked>Ele gelmiyor</label>
                                <label><input type="radio" name="tiroid" value="0" >Büyümüş</label>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Aksiller Ateş : </label> <input type="text" class="" id="ates" name="ates">
                            </div>
                </div>

                        <div class="row" style="margin: 5px;padding-top: 15px; border: thin; border-color: #3d6983; font-size: 12pt">
                            <strong style="font-size: 14pt; color: #222222">Tanı</strong>
                            <hr>

                            <div class="form-group col-md-12">
                                <label for="name">Ön Tanı ve Tedavi Bilgisi :  </label>
                                <textarea style="resize: none"  class="form-control" id="tedavi" name="tedavi"></textarea>
                            </div>
                        </div>
            </div>


                <div class="panel-footer">
                    <div class="text-center">
                        <input style="width: 350px" type="submit" value="Kayıt" class="btn btn-primary">
                    </div>
                </div>
                </form>


        </div>

            <script src="{{ asset('js/autocomplete.js') }}"></script>
            <script>
                document.getElementById('date').valueAsDate = new Date();
                $(document).ready(function () {

                    $('#autocomplete').autocomplete({
                        serviceUrl: '/patients/search',
                        onSelect: function (suggestion) {
                            window.location.href = "{{ \Illuminate\Support\Facades\URL::to('/') }}" + "/examinations/new?patient_id=" + suggestion.data;

                        }
                    });

                });

                $( "#kilo" ).change(function() {
                    computeBMI();
                });

                $( "#boy" ).change(function() {
                    computeBMI();
                });

                function computeBMI() {
                    // user inputs
                    var height = Number(document.getElementById("boy").value);
                    var weight = Number(document.getElementById("kilo").value);
                    //Perform calculation

                    //        var BMI = weight /Math.pow(height, 2)*10000;
                    var BMI = Math.round(weight / Math.pow(height, 2) * 10000);
                    console.log(BMI);
                    //Display result of calculation
                    if(BMI != 0)
                    document.getElementById("bmi").value = Math.round(BMI * 100) / 100;
                }

            </script>

    </div>
@endsection

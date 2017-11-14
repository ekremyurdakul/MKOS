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
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#collapse1">Solunum Sistemi Muayanesi</a>
                                    </h4>
                                </div>
                                <div id="collapse1" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="form-group col-md-4">
                                            <label for="height">SDS</label>
                                            <input type="text" class="form-control" id="boy" name="solunum_sds">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="height">Toraks ins.</label>
                                            <input type="text" class="form-control" id="boy" name="solunum_toraks_ins">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="height">Toraks Palpas.</label>
                                            <input type="text" class="form-control" id="boy" name="solunum_toraks_palpas">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="height">Perküsyon</label>
                                            <input type="text" class="form-control" id="boy" name="solunum_perkusyon">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#collapse2">Kardiyo-Vasküler Muayanesi</a>
                                    </h4>
                                </div>
                                <div id="collapse2" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="form-group col-md-4">
                                            <label for="height">Periferik Nabızlar</label>
                                            <input type="text" class="form-control" id="boy" name="kardiyo_periferik_nabz">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="height">NDS</label>
                                            <input type="text" class="form-control" id="boy" name="kardiyo_nds">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="height">Palpasyon</label>
                                            <input type="text" class="form-control" id="boy" name="kardiyo_palpasyon">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="height">Oskültasyon</label>
                                            <input type="text" class="form-control" id="boy" name="kardiyo_oskultasyon">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="height">Venüz Dolgunluk</label>
                                            <input type="text" class="form-control" id="boy" name="kardiyo_venuz_dolgunluk">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#collapse3">Gastro-İntestinal Sistem Muayanesi</a>
                                    </h4>
                                </div>
                                <div id="collapse3" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="form-group col-md-4">
                                            <label for="height">İnspeksiyon</label>
                                            <input type="text" class="form-control" id="boy" name="gastro_inspeksiyon">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="height">Tonsiller ve Faren</label>
                                            <input type="text" class="form-control" id="boy" name="gastro_tonsiller">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="height">Palpasyon</label>
                                            <input type="text" class="form-control" id="boy" name="gastro_palpasyon">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="height">Perküsyon</label>
                                            <input type="text" class="form-control" id="boy" name="gastro_perkusyon">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="height">Perküsyon</label>
                                            <input type="text" class="form-control" id="boy" name="gastro_oskultasyon">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#collapse4">Genito-Üriner Sistem Muayanesi</a>
                                    </h4>
                                </div>
                                <div id="collapse4" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="form-group col-md-4">
                                            <label for="height">İnspeksiyon</label>
                                            <input type="text" class="form-control" id="boy" name="genito_kuntperk">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="height">Üreter Noktaları</label>
                                            <input type="text" class="form-control" id="boy" name="genito_ureternoktalar">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="height">Suprapubik Böl.</label>
                                            <input type="text" class="form-control" id="boy" name="genito_suprapubik">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#collapse5">Lokomotor Sistem Muayanesi</a>
                                    </h4>
                                </div>
                                <div id="collapse5" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="form-group col-md-12">
                                            <label for="name">Notlar</label>
                                            <textarea style="resize: none"  class="form-control" id="tedavi" name="lokomotor_notlar"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#collapse6">Nörolojik Sistem Muayanesi</a>
                                    </h4>
                                </div>
                                <div id="collapse6" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="form-group col-md-4">
                                            <label for="height">Ense Sertliği</label>
                                            <input type="text" class="form-control" id="boy" name="noro_ense_sertligi">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="height">Kernig Belirtisi</label>
                                            <input type="text" class="form-control" id="boy" name="noro_kernig">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="height">Brudzinski Belirtisi</label>
                                            <input type="text" class="form-control" id="boy" name="noro_bruzinski">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="height">Lasegue (SAĞ)</label>
                                            <input type="text" class="form-control" id="boy" name="noro_lasegue_sag">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="height">Lasegue (SOL)</label>
                                            <input type="text" class="form-control" id="boy" name="noro_lasegue_sol">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="height">Femoral (SOL)</label>
                                            <input type="text" class="form-control" id="boy" name="noro_femoral_sag">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="height">Femoral (SOL)</label>
                                            <input type="text" class="form-control" id="boy" name="noro_femoral_sol">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="name">Notlar</label>
                                            <textarea style="resize: none"  class="form-control" id="tedavi" name="noro_notlar"></textarea>
                                        </div>
                                    </div>
                                </div>
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
                        <div class="row" style="margin: 5px;padding-top: 15px; border: thin; border-color: #3d6983; font-size: 12pt">
                            <strong style="font-size: 14pt; color: #222222">Bitirilsin mi ?</strong>
                            <hr>
                            <div class="form-group col-md-12">
                                <input name="completed" style="width: 30px;height: 30px" type="checkbox">
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

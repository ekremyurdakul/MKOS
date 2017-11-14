@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong style="font-size: large">@php echo $patient->name . ' ' . $patient->surname @endphp</strong>
                    </div>

                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a  data-toggle="tab" href="#info">Hasta Bilgileri ve İşlemler</a></li>
                        <li><a  data-toggle="tab" href="#tests">Tetkikler</a></li>
                        <li><a  data-toggle="tab" href="#examinations">Muayeneler</a></li>
                        <li><a  data-toggle="tab" href="#documents">Dökümanlar</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="info" class="tab-pane fade in active">

                            <div style="padding: 10px" class="row">
                                <div class="col-md-4">
                                    <h3>İşlemler</h3>
                                    <a href="/examinations/new?patient_id={{$patient->id}}" style="width: 100%;margin-top: 10px" class="btn btn-primary">Muayene Ekle</a>
                                    <a href="/documents/new?patient_id={{$patient->id}}" style="width: 100%;margin-top: 10px" class="btn btn-primary">Tetkik/Döküman Ekle</a>
                                    <a style="width: 100%;margin-top: 10px" class="btn btn-danger">Hasta Sil</a>
                                </div>
                                <div class="col-md-4">
                                    <form method="POST" action="/patients/edit">
                                        <input type="hidden" name="patient_id" value="{{$patient->id}}">
                                        {{csrf_field()}}
                                        <div class="form-group">
                                            <label for="name">Dosya Numarası: </label>
                                            <input value="{{$patient->document_no}}" type="text" class="form-control" id="name" name="dosya_no">
                                        </div>

                                        <div class="form-group">
                                            <label for="name">Ad : </label>
                                            <input value="{{$patient->name}}" type="text" class="form-control" id="name" name="isim">
                                        </div>

                                        <div class="form-group">
                                            <label for="name">Soyad : </label>
                                            <input value="{{$patient->surname}}" type="text" class="form-control" id="name" name="soyisim">
                                        </div>

                                        <div class="radio">
                                            <label><input type="radio" name="cinsiyet" value="M" {{$patient->gender == 'M' ? 'checked' : ''}}>Bay</label>
                                            &nbsp;&nbsp;&nbsp;
                                            <label><input type="radio" name="cinsiyet" value="F" {{$patient->gender == 'F' ? 'checked' : ''}}>Bayan</label>
                                        </div>

                                        <div class="form-group">
                                            <label for="name">Doğum Tarihi : </label>
                                            <input value="{{$patient->DOB}}" type="date" class="form-control" id="dob" name="dogum_tarihi">
                                        </div>

                                        <div class="form-group">
                                            <label for="name">Meslek : </label>
                                            <input value="{{$patient->occupation}}" type="text" class="form-control" id="occupation" name="meslek">
                                        </div>

                                        <div class="form-group">
                                            <label for="name">Adres : </label>
                                            <input value="{{$patient->address}}" type="text" class="form-control" id="address" name="adres">
                                        </div>

                                        <div class="form-group">
                                            <label for="name">İş tel : </label>
                                            <input value="{{$patient->business_tel}}" type="text" class="form-control" id=business_tel name="is_tel">
                                        </div>

                                        <div class="form-group">
                                            <label for="name">Ev tel : </label>
                                            <input value="{{$patient->home_tel}}" type="text" class="form-control" id="home_tel" name="ev_tel">
                                        </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Alerji Hikayesi :  </label>
                                        <textarea style="resize: none"  class="form-control" id="allergy" name="alerji">{{$patient->allergy_info}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Öz/Soy Geçmişi : </label>
                                        <textarea style="resize: none" class="form-control" id="notes" name="ozgecmis">{{$patient->history}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Devamlı Kullandığı İlaçlar : </label>
                                        <textarea style="resize: none" class="form-control" id="notes" name="ilaclar">{{$patient->medicines}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Notlar : </label>
                                        <textarea style="resize: none" class="form-control" id="notes" name="notlar">{{$patient->notes}}</textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="row text-center">
                                <div class="col-md-4"></div>
                                <div class="col-md-6">
                                    <input class="btn-primary btn" style="width: 700px; margin: 20px" value="Kaydet" type="submit">
                                </div>
                            </div>
                        </div>

                        <div id="tests" class="tab-pane fade">
                            <div style="padding: 10px" class="row">
                                <div class="col-md-12">
                                    <h3>Tetkikler</h3>
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Tarih</th>
                                            <th scope="col">Açıklama</th>
                                            <th scope="col"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($patient->documents()->where('document_type_id',2)->orderBy('created_at','desc')->get() as $document)
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>{{date('d-m-Y',strtotime($document->date))}}</td>
                                                <td>{{$document->name}}</td>
                                                <td><a onclick=" window.open( '@php echo url('documents/inspect/') . '/' . $document->id ; @endphp ', '_blank'); " class="btn btn-default">İncele</a></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div id="examinations" class="tab-pane fade">
                            <div style="padding: 10px" class="row">
                                <div class="col-md-12">
                                    <h3>Muayeneler</h3>
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Tarih</th>
                                            <th scope="col">Şikayet</th>
                                            <th scope="col">Durum</th>
                                            <th scope="col"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($patient->examinations()->orderBy('created_at','desc')->get() as $examination)
                                            <tr @if(!$examination->completed) class="danger" @endif>
                                                <th scope="row">1</th>
                                                <td>{{date('d-m-Y',strtotime($examination->date))}}</td>
                                                <td>{{$examination->sikayet}}</td>
                                                <td>{{ $examination->completed ? 'Tamamlandı' : 'Tamamlanmadı' }}</td>
                                                <td><a onclick=" window.open( '@php echo url('examinations/edit/') . '/' . $examination->id ; @endphp ', '_blank'); " class="btn btn-default">İncele</a></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="documents" class="tab-pane fade">
                            <div style="padding: 10px" class="row">
                                <div class="col-md-12">
                                    <h3>Dökümanlar</h3>
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Tarih</th>
                                            <th scope="col">Açıklama</th>
                                            <th scope="col"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($patient->documents()->where('document_type_id',1)->orderBy('created_at','desc')->get() as $document)
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>{{date('d-m-Y',strtotime($document->date))}}</td>
                                                <td>{{$document->name}}</td>
                                                <td><a onclick=" window.open( '@php echo url('documents/inspect/') . '/' . $document->id ; @endphp ', '_blank'); " class="btn btn-default">İncele</a></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
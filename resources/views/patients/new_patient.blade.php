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
                    <div class="panel-heading"><strong style="font-size: large">Yeni Hasta Kaydı</strong></div>

                    <form method="POST" action="/patients/create">
                    {{csrf_field()}}
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Ad : </label>
                                        <input type="text" class="form-control" id="name" name="isim">
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Soyad : </label>
                                        <input type="text" class="form-control" id="name" name="soyisim">
                                    </div>

                                    <div class="radio">
                                        <label><input type="radio" name="cinsiyet" value="M" checked>Bay</label>
                                        &nbsp;&nbsp;&nbsp;
                                        <label><input type="radio" name="cinsiyet" value="F">Bayan</label>
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Doğum Tarihi : </label>
                                        <input type="date" class="form-control" id="dob" name="dogum_tarihi">
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Meslek : </label>
                                        <input type="text" class="form-control" id="occupation" name="meslek">
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Adres : </label>
                                        <input type="text" class="form-control" id="address" name="adres">
                                    </div>

                                    <div class="form-group">
                                        <label for="name">İş tel : </label>
                                        <input type="text" class="form-control" id=business_tel name="is_tel">
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Ev tel : </label>
                                        <input type="text" class="form-control" id="home_tel" name="ev_tel">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Alerji Hikayesi :  </label>
                                        <textarea style="resize: none"  class="form-control" id="allergy" name="alerji">
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Notlar : </label>
                                        <textarea style="resize: none" class="form-control" id="notes" name="notlar">
                                        </textarea>
                                    </div>
                                </div>



                    </div>

                    <div class="panel-footer">
                        <div class="text-center">
                            <button style="width: 350px" type="submit" class="btn btn-primary">Kayıt</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

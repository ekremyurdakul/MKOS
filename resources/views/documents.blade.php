
        @extends('layouts.app')

        @section('content')
            @include('search_customer')
            <style>
                img.scanned {
                    height: 200px; /** Sets the display size */
                    margin-right: 12px;
                }
                div#images {
                    margin-top: 20px;
                }
            </style>
            <div class="container">
                <form method="POST" action="/documents/new">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">

                                <strong style="font-size: large">Tetkik/Döküman Girişi</strong>
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
                                    <strong style="font-size: 14pt; color: #222222">Döküman/Tetkik Bilgisi</strong>
                                    <hr>

                                    <div class="form-group col-md-12">
                                        <label for="height">Döküman İsmi : </label>
                                        <input type="text" class="form-control" id="boy" name="dokuman_adi">
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="dokuman_tip">Döküman Tipi : </label>
                                        <select class="form-control" name="dokuman_tip" id="dokuman_tip">
                                            @foreach(\App\DocumentType::all() as $type)
                                                <option value="{{$type->id}}">{{$type->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row" style="margin: 5px;padding-top: 15px; border: thin; border-color: #3d6983; font-size: 12pt">
                                    <strong style="font-size: 14pt; color: #222222">Testler</strong>
                                    <hr>
                                    <table id="table_tests" style="margin-top: 15px" class="table table-striped ">
                                        <thead>
                                        <tr>
                                            <th>Test</th>
                                            <th>Sonuç</th>

                                        </tr>
                                        </thead>
                                        <tbody id="items_table">
                                        </tbody>
                                    </table>
                                    <a style="margin: 0 5px 0 0" onclick="addCut()" class="btn btn-primary"> Test Ekle
                                    </a>
                                    <a style="margin: 0 0 0 0" onclick="removeCut()" class="btn btn-danger"> Test Çıkar
                                    </a>
                                </div>

                                <div class="row" style="margin: 5px;padding-top: 15px; border: thin; border-color: #3d6983; font-size: 12pt">
                                    <strong style="font-size: 14pt; color: #222222">Dökümanlar</strong>
                                    <hr>
                                    <button class="btn btn-primary" type="button" onclick="scanToJpg();">Taramaya Başla</button>
                                    <div id="images"></div>
                                </div>
                        <div class="panel-footer">
                            <div class="text-center">
                                <input style="width: 350px" type="submit" value="Kayıt" class="btn btn-primary">
                            </div>
                        </div>


                        </form>


                    </div>

                        <script type="text/javascript" src="{{ URL::asset('js/scanner.js') }}"></script>

                    <script src="{{ asset('js/autocomplete.js') }}"></script>
                    <script>
                        function removeCut() {
                            var table = document.getElementById("table_tests");
                            if (table.rows.length > 1) {
                                document.getElementById("table_tests").deleteRow(table.rows.length - 1);
                            }
                        }
                        function addCut() {

                            var table = document.getElementById('table_tests');
                            var length = table.rows.length;
                            var row = table.insertRow();
                            var cell1 = row.insertCell(0);
                            var cell2 = row.insertCell(1);

                            cell1.innerHTML = "<input name='tests[]' class='form-control' required>";
                            cell2.innerHTML = "<input id='cuts' name='results[]' class='form-control' required>";

                        }
                        function scanToJpg() {
                            scanner.scan(displayImagesOnPage,
                                {
                                    "output_settings": [
                                        {
                                            "type": "return-base64",
                                            "format": "jpg"
                                        }
                                    ]
                                }
                            );
                        }
                        function displayImagesOnPage(successful, mesg, response) {
                            if(!successful) { // On error
                                console.error('Failed: ' + mesg);
                                return;
                            }
                            if(successful && mesg != null && mesg.toLowerCase().indexOf('user cancel') >= 0) { // User cancelled.
                                console.info('User cancelled');
                                return;
                            }
                            var scannedImages = scanner.getScannedImages(response, true, false); // returns an array of ScannedImage
                            $('#images').empty();
                            for(var i = 0; (scannedImages instanceof Array) && i < scannedImages.length; i++) {
                                var scannedImage = scannedImages[i];
                                processScannedImage(scannedImage);
                            }
                        }
                        /** Images scanned so far. */
                        var imagesScanned = [];
                        /** Processes a ScannedImage */
                        function processScannedImage(scannedImage) {
                            imagesScanned.push(scannedImage);
                            var elementImg = scanner.createDomElementFromModel( {
                                'name': 'img',
                                'attributes': {
                                    'class': 'form-group col-md-6',
                                    'src': scannedImage.src,
                                    'name': 'img[]'
                                }
                            });
                            var inputReference = scanner.createDomElementFromModel( {
                                'name': 'input',
                                'attributes': {
                                    'class': 'hidden',
                                    'value': scannedImage.src,
                                    'name': 'img[]'
                                }
                            });
                            document.getElementById('images').appendChild(elementImg);
                            document.getElementById('images').appendChild(inputReference);
                        }
                        
                        document.getElementById('date').valueAsDate = new Date();
                        $(document).ready(function () {

                            $('#autocomplete').autocomplete({
                                serviceUrl: '/patients/search',
                                onSelect: function (suggestion) {
                                    window.location.href = "{{ \Illuminate\Support\Facades\URL::to('/') }}" + "/documents/new?patient_id=" + suggestion.data;

                                }
                            });


                        });
                    </script>

                </div>
@endsection

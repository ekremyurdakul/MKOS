<?php

namespace App\Http\Controllers;

use App\Content;
use App\Document;
use App\DocumentType;
use App\Patient;
use App\Test;
use Illuminate\Http\Request;
use Alert;

use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $Patient = null;
        if(isset($_GET['patient_id'])){
            $Patient = Patient::find($_GET['patient_id']);
        }
        return view('documents')->with(['patient'=>$Patient]);
    }
    public function create(Request $request){

        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'dokuman_adi' => 'required',
            'dokuman_tip' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error('Form Yanlış', 'Kayıt');
            return redirect()->back()->withInput();
        }
        if($request->patient_id == null){
            Alert::error('Hasta Seçilmelidir', 'Kayıt');
            return redirect()->back()->withInput();
        }
        $document = Document::create([
            'name'=>$request->dokuman_adi,
            'date'=>$request->date,
            'patient_id'=>$request->patient_id,
            'document_type_id'=>$request->dokuman_tip,

        ]);
        $counter = 1;
        if($request->img != null)
        foreach($request->img as $image){
            $db_path = 'documents/' .  (string) $counter. '-' . (string) $document->id .'.jpg';
            $path    = storage_path('app/' . $db_path);
            $data
                = base64_decode(preg_replace('#^data:image/\w+;base64,#i',
                '', $image));
            file_put_contents($path, $data);

            Content::create([
                'location' => $db_path,
                'document_id' => $document->id,
            ]);
        }
        $counter = 0;
        if($request->tests != null)
        foreach($request->tests as $test){

            Test::create([
                'document_id' => $document->id,
                'name'=>$test,
                'result'=>$request->results[$counter],
            ]);
            $counter++;
        }

        Alert::success('Döküman ilgili hastaya eklenmiştir.', 'Kayıt');
        //TODO redirect to patient card
        return redirect('/home');
    }
}

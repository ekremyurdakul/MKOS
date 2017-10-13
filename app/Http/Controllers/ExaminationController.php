<?php

namespace App\Http\Controllers;

use App\Examination;
use App\Patient;
use Illuminate\Http\Request;
use Alert;

class ExaminationController extends Controller
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

        return view('examinations.new_examination')->with(['patient'=>$Patient]);
    }

    public function create(Request $request){
        if($request->patient_id == null){
            Alert::error('Hasta Seçilmelidir', 'Kayıt');
            return redirect()->back()->withInput();
        }
        $payload = $request->all();
        unset($payload['_token']);

        $examination =  new Examination();
        foreach ($payload as $key => $value)
        {
            $examination[$key] = $value;
        }

        $examination->save();

        Alert::success('Muayene ilgili hastaya eklenmiştir.', 'Kayıt');
        //TODO redirect to patient card
        return redirect('/home');
    }

}

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

    public function test(){
            $this->retrieveData('137799','1971','4521911');

    }

    public function retrieveData($identity,$birthYear,$opNo){
        $query_str = "http://hastane.sisoft.com.tr/kibris/lab/1.php?tur=tetkiksonuc&tcKimlikNo=".$identity."&dogumYil=".$birthYear."&pi_key=".$opNo;

        $raw_xml = file_get_contents($query_str);

            $xml = simplexml_load_string($raw_xml);
        $retVal = array();
        foreach ($xml->HASTA->TETKIKLER->TETKIK as $examination){
            foreach($examination->TEST as $test){
                if(is_string((string)$test->TESTADI) && is_string((string)$test->SONUC)
                    && (string)$test->TESTADI != "" && (string)$test->SONUC != "")
                    $retVal[(string)$test->TESTADI] = (string)$test->SONUC;
            }
        }
        return json_encode($retVal);
    }

}

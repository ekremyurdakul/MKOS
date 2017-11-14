<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;

use Alert;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){
        return view('patients.new_patient');
    }
    public function create(Request $request){
        $request->validate([
            'dosya_no' => 'required|unique:patients,document_no|max:255',
            'isim' => 'required|max:255',
            'soyisim' => 'required|max:255',
            'dogum_tarihi' => 'required|date',
            'meslek' => 'max:255',
            'adres' => 'max:255',
            'is_tel' => 'max:255',
            'ev_tel' => 'max:255',
            'alerji' => 'max:255',
            'not' => 'max:255',
            'cinsiyet'=>'required'
        ]);
        //basic validations
        if(count(Patient::where('document_no',$request->document_no)->get()) > 0 ){
            Alert::error('Aynı dosya numarasında kayıt bulunmaktadır', 'Kayıt');

            return redirect()->back()->withInput();
        }
        if(count(Patient::where('name',$request->isim)->where('surname',$request->soyisim)->where('dob',$request->dogum_tarihi)->get()) > 0 ){
            Alert::error('Aynı isimde soyisimde ve doğum tarihinde başka bir kayıt bulunmaktadır', 'Kayıt');

            return redirect()->back()->withInput();
        }

        Patient::create([
            'document_no'=>$request->dosya_no,
            'name'  =>  $request->isim,
            'surname'  =>  $request->soyisim,
            'gender'=>$request->cinsiyet,
            'dob'=>$request->dogum_tarihi,
            'occupation'=>$request->meslek,
            'address'=>$request->address,
            'business_tel'=>$request->is_tel,
            'home_tel'=>$request->ev_tel,
            'allergy_info'=>$request->alerji,
            'notes'=>$request->notlar,
            'history'=>$request->ozgecmis,
            'medicines'=>$request->ilaclar,
        ]);

        Alert::success('Hasta Başarıyla Kaydedildi !', 'Kayıt');

        return redirect('/home');

    }
    public function edit(Request $request){

        $request->validate([
            'isim' => 'required|max:255',
            'soyisim' => 'required|max:255',
            'dogum_tarihi' => 'required|date',
            'meslek' => 'max:255',
            'adres' => 'max:255',
            'is_tel' => 'max:255',
            'ev_tel' => 'max:255',
            'alerji' => 'max:255',
            'not' => 'max:255',
            'cinsiyet'=>'required'
        ]);
        $patient = Patient::find($request->patient_id);


        if(count(Patient::where('document_no',$request->document_no)->get()) > 0 && $request->document_no != $patient->document_no){
            Alert::error('Aynı dosya numarasında kayıt bulunmaktadır', 'Kayıt');

            return redirect()->back()->withInput();
        }
        $payload = $request->all();

        unset($payload['_token']);
        unset($payload['patient_id']);

        Patient::where('id',$request->patient_id)->update([
            'document_no'=>$request->dosya_no,
            'name'=>$request->isim,
            'surname'=>$request->soyisim,
            'DOB'=>$request->dogum_tarihi,
            'occupation'=>$request->meslek,
            'address'=>$request->adres,
            'business_tel'=>$request->is_tel,
            'home_tel'=>$request->ev_tel,
            'allergy_info'=>$request->alerji,
            'medicines'=>$request->ilaclar,
            'history'=>$request->ozgecmis,
            'notes'=>$request->notlar,
            'gender'=>$request->cinsiyet,
        ]);

        Alert::success('Hasta bilgileri başarıyla güncellendi !', 'Kayıt');

        return redirect()->back()->withInput();
    }


    public function card($id){
        return view('patients.card')->with('patient',Patient::find($id));
    }

    public function smartSearch(){
        $search   = array_pop($_GET);
        // Turkish char fix
        $search = str_replace("ı", "i", $search);

        $patients = Patient::orderBy('name','desc')
            ->orWhere('name', 'LIKE', "%{$search}%")
            ->orWhere('surname', 'LIKE', "%{$search}%")
            ->orWhere(DB::raw('CONCAT(name, "", surname)'), 'LIKE', "%{$search}%")
            ->orWhere(DB::raw('CONCAT(name, " ", surname)'), 'LIKE', "%{$search}%")
            ->get();

        $suggestions = array();
        foreach ($patients as $patient){
            array_push($suggestions,['value'=>$patient->name . ' ' . $patient->surname,'data'=>$patient->id]);
        }

        return json_encode(["suggestions"=>$suggestions]);
    }


}

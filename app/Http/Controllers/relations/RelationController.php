<?php

namespace App\Http\Controllers\relations;

use App\Models\Country;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\phone;
use App\Models\Service;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RelationController extends Controller
{

    /* =========================================== start One To One ========================== */
    public function hasOneRelation(){
        $user=User::with(['phone'=>function($q){
            $q->select(['code','phone','user_id']);
        }])->find(3);
        //$phone=$user->phone();
        return response()->json($user);
        //return $user->phone->code;
    }

    public function hasOneRelationRevers(){
        //$phone=phone::with(['user'])->find(1);
        $phone=phone::with(['user'=>function($q){
            $q->select(['id','name']);
        }])->find(1);
        $phone->makeVisible(['user_id']);
        //$phone->makeHidden(['code']);
        //$phone->user;
        return response()->json($phone);
    }

    public function getUserHasPhone(){
        $user=User::whereHas('phone',function($q){
            $q->where('code','970');
        })->get();
        /* $user=User::whereHas('phone')->with(['phone'=>function($q){
            $q->select(['phone']);
        }])->select(['id','name'])->get(); */
        return response()->json($user);
    }

    public function getUserNotHasPhone(){
        return User::whereDoesntHave('phone')->get();
    }

    /* =========================================== End One To One ========================== */

    /* =========================================== Start One To Many ========================== */

    public function getHos(){
        //$hos=Hospital::with('doctors')->get();
        //return response()->json($hos);
        $hospitals=Hospital::select('id','name','address')->get();

        /* $doc=Doctor::with(['hospital'=>function($q){
            $q->select(['name']);
        }])->get(); */
        return view('doctors.hospitals',compact('hospitals'));
    }

    public function getDoc($hos_id){
        /* $doctors=Doctor::with(['hospital'=>function($q){
            $q->select(['id','name']);
        }])->where('hospital_id',$hos_id)->get();  */
        $hos=Hospital::find($hos_id);
        $doctors=$hos->doctors;
        return view('doctors.doctorsInHos',compact('doctors'));
        //return response()->json($doctors);
    }

    public function getHosHasDoc(){
        $hospitals=Hospital::whereHas('doctors')->get();
        //$hospitals=Hospital::whereDoesntHave('doctors')->get();
        return view('doctors.hosHasDoc',compact('hospitals'));
    }

    public function allDoc(){
        $doctors=Doctor::with(['services'])->get();
        //return response()->json($doctors);
        return view('doctors.allDoc',compact('doctors'));
    }
    public function maleDoc(){
        $doctors=Doctor::where('gender',1)->get();
        return view('doctors.mail',compact('doctors'));
    }

    public function hosDelete(Request $request){
        $hos=Hospital::find($request->id);
        if(!$hos){
            return response()->json([
                'status'    => false,
                'msg'       => 'hospital is not exist'
            ]);
        }
        $hos->doctors()->delete();
        $hos->delete();
        return response()->json([
            'status'    => true,
            'msg'       => 'hospital is deleted',
            'id'        => $request->id
        ]);
    }

        /* =========================================== End One To Many ========================== */
        
        /* =========================================== Start Many To Many ========================== */
        public function docSer(){
            return $doctors=Doctor::with('services')->get();
        }

        public function serDoc(){
            return $services=Service::with('doctors')->find(2);
        }
        
        public function showSerForDoc($doc_id){
            $doctor=Doctor::find($doc_id);
            $services=$doctor->services;
            $doctors=Doctor::select('id','name')->get();
            $allServices=Service::select('id','name')->get();
            return view('doctors.services',compact('services','doctors','allServices','doc_id'));
        }

        public function AllServices(){
            $services=Service::select('id','name')->get();
            $doctors=Doctor::select('id','name')->get();
            return view('doctors.allServices',compact('services','doctors'));
        }

        public function saveSerToDoc(Request $request){
            $doctor=Doctor::find($request->doctor_id);
            if( !$doctor){
                return abort('404');
            }
            //$doctor->services()->attach($request->services_id);
            //$doctor->services()->sync($request->services_id);
            $doctor->services()->syncWithoutDetaching($request->services_id);

            return redirect()->back();
        }
        /* =========================================== End Many To Many ========================== */

        /* =========================================== Has One Through ============================*/
        public function getpatients(){
            $pat=Patient::find(2);
            return $pat->doctors;
        }
        /* =========================================== Has mANY Through ============================*/

        public function docByCon(){
            return $coun=Country::with('doctors')->get()->where('id',1);

            //return $coun->doctors;
            //return $coun->name;
            //return $coun->hospitals;
            /* $country=Country::get();
            foreach($country as $con){
                foreach($con->doctors as $doc){
                    echo $doc->name .',';
                }
            } */
        }

/* ======================================== Accessors ======================================= */

        public function getDocs(){
            $doctors=Doctor::select('id','name','gender')->get();
            /* foreach($doctors as $doc){
                $doc->gender=$doc->gender==1?'male':'female';
            } */
            return $doctors;
        }
}
/* ======================================== Accessors ======================================= */


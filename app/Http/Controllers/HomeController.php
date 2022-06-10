<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function redirect()
    {
       if(Auth::id()){
           if(Auth::user()->usertype == '0'){
            $doctor = Doctor::all();
            return view('user.home',compact('doctor'));
           
        }else{
               return view('admin.home'); 
           }

       }else
       {
           return redirect()->back();
       }
    }

    public function index()
    {
        if(Auth::id())
        {
            return redirect('home');
        }
        else
        {
        $doctor = Doctor::all();
        return view('user.home',compact('doctor'));
        }
    }
    //function to handle appointment form data 
     function appointment(Request $request)
    {
     $data = new Appointment;
     $data->name = $request->name;
     $data->email = $request->email;  
     $data->date = $request->date;
     $data->phone = $request->number;
     $data->message = $request->message;
     $data->doctor = $request->doctor;
     $data->status = 'In Progress';
     if(Auth::id())
     {
        $data->user_id = Auth::user()->id; 
     }
    $data->save();
    return redirect()->back()->with('message','Request Successful👍, we will contanct you soon');
    
    }

    //myappoint function
    public function myappointment()
    {
        //This page should only be show if the person is logged
        if (Auth::id()) {
            //if the userId and and the useris in the database matches , it should return the myappointpage
            $userId = Auth::user()->id;
            $appoint = appointment::where('user_id', $userId)->get();

            return view('user.my_appointment', compact('appoint'));
        }
        else {
            return redirect()->back();
        }
    }

    //Delete function to cancel appointment
    public function cancel_appoint($id)
    {
        $data = appointment::find($id);
        $data->delete();
        return redirect()->back();
    }
}
 
<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Notifications\sendEmailNotification;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function addview()
    {
        if (Auth::id()) {
            if (auth::user()->usertype == 1) {
                return view('admin.add_doctor');
            }
            else {
                return redirect()->back();
            }
        }
        else {
            return redirect('login');
        }

    }

    public function upload(Request $request)
    {
       $doctor = new Doctor;
       $image=$request->file;
       $imageName = time().'.'.$image->getClientoriginalExtension();
       $request->file->move('doctorImage',$imageName);
       $doctor->image = $imageName;  
       $doctor->name = $request->name;
       $doctor->phone = $request->number;
       $doctor->room = $request->room;
       $doctor->speciality = $request->speciality;
       $doctor->save();
       return redirect()->back()->with('message','Doctor succesfully added');
    }
    //function to show appointmentson admin panel
    public function showAppointment()
    { //get all appointment data   
        if (Auth::id()) {
            if (auth::user()->usertype == 1) {
                $data = appointment::all();
                return view('admin.show_appointment',
                    compact('data')); //send data to the view
            }
        }
        else {
            return redirect('login');
        }

    }
    //appppointment approval function
    public function approved($id)
    {
        $data = appointment::find($id);
        $data->status='Approved';
        $data->save();
        return redirect()->back();
    }
    //cancel appointment
    public function cancel($id)
    {
        $data = appointment::find($id);
        $data->status ='canceled';
        $data->save();
        return redirect()->back(); 
    }

    //show all doctors
    public function showDoctors()
    {
        //send dr data to the view
        $data = doctor::all();
       return view('admin.show_doctors', compact('data'));
    }

    //delete doctor
    public function deleteDoctor($id)
    {
       $data = doctor::find($id);
       $data->delete();
       return redirect()->back();
    }
    //update doctor's details
    public function updateDoctor($id)
    {
      $data =  doctor::find($id) ;
      return view('admin.update_doctor',compact('data'));
    }
    //edit doctor details
    public function editDoctor(Request $request , $id)
    {
       $doctor = doctor::find($id);
       $doctor->name = $request->name;
       $doctor->phone = $request->phone;
       $doctor->speciality = $request->speciality;
       $doctor->room = $request->room;

      
      //handling the image request

        $image = $request->file; //requesting file from the blade
        if ($image) 
        {
            $imageName = time() . '.' . $image->getClientoriginalExtension(); //changing the image name using the time function
            $request->file->move('doctorImage', $imageName); //the file will be moved to this location
            $doctor->image = $imageName;
            
        }
        $doctor->save();
      return redirect()->back()->with('message', 'Update Successful🎉🎉');



    } 
    public function emailView($id)
    {
        $data = appointment::find($id);
        return view('admin.email_view',compact('data'));
    }
    public function sendemail(Request $request, $id)
    {
        $data= appointment::find($id);
        $details =[
            'greeting'=> $request->greeting,
            'body'=> $request->body,
            'actiontext'=>$request->actiontext,
            'actionurl'=>$request->actionurl,
            'endpart'=>$request->endpart
            ];

            Notification::Send($data, new sendEmailNotification($details));

            return redirect()->back()->with('message','Email sent🎉🎉'); 
    }
}

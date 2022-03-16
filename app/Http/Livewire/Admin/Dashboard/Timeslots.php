<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\Appointment;
use App\Models\AppointmentDate;
use App\Models\AppointmentTime;
use App\Models\PatientInformation;
use Livewire\Component;

class Timeslots extends Component
{
    public $aDid;   
    public $tsID;
    public $available_slots= "-";
    public $total_slots = "-";
    public $occupied_slots = "-";
    public $searchterm = "";
    public function render()
    {
        //convert $aDid to integer
        $this->aDid = intval($this->aDid);
        //if tsID is not set, then set it to the first id from AppointmentTime table where appointment_id = aDid
        if(!isset($this->tsID)){
            $this->tsID = AppointmentTime::where('appointment_date_id', $this->aDid)->first()->id;
        }
        $pIDs=[];
        $appointments=[];
        if($this->searchterm != ""){
            $pa= PatientInformation::orWhere('first_name','like',"%".$this->searchterm."%")->orWhere('middle_name','like',"%".$this->searchterm."%")->orWhere('last_name','like',"%".$this->searchterm."%")->get('id');
            foreach ($pa as $key => $value) {
                $pIDs[] = $value->id;
            }
            array_values($pIDs);
            $appointments = Appointment::where('appointment_date_id',$this->aDid)->where('appointment_time_id',$this->tsID)->whereIn('patient_id',$pIDs)->get();
        }else{
            $appointments = Appointment::where('appointment_date_id',$this->aDid)->where('appointment_time_id',$this->tsID)->get();
        }
       
        return view('livewire.admin.dashboard.timeslots',['vaccine_name'=>AppointmentDate::find($this->aDid)->vaccine->vaccine_name,'tslots'=>AppointmentTime::where('appointment_date_id',$this->aDid)->get(),
        'appointments'=>$appointments]);
    }

    public function getAppointments($id)
    {
        $this->tsID = $id;
        $at = AppointmentTime::findOrFail($id);
        $this->available_slots = $at->available_slots;
        $this->total_slots = $at->max_slots;
        $this->occupied_slots = $at->max_slots - $at->available_slots;
    }
}
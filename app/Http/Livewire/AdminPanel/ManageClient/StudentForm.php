<?php

namespace App\Http\Livewire\AdminPanel\ManageClient;

use App\Models\Course;
use App\Models\Student;
use App\Models\UserActivityLogsDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StudentForm extends Component
{
    public  $data = [];
    public  $course_id,
            $id_number,
            $first_name,
            $last_name,
            $middle_name,
            $birth_date;
    public  $StudentID;
    
    protected $listeners = [
    'editStudentData',
    'selectedCourse'
    ];
    
    public function selectedCourse($id){

        if($id){
            $this->course_id = $id;
        }else{
            $this->course_id = null;
        }
    }
    
    public function render()
    {
        return view('livewire.admin-panel.manage-client.student-form',[
            'Course_Data' =>  Course::orderBy('course_name', 'ASC')->get()
        ]);
    }
    
    public function hydrate(){
        $this->emit('select2');
    }
    
    public function editStudentData($StudentID)
    {
        $this->StudentID=$StudentID;
        $DATA=Student::find($this->StudentID);
        $this->course_id = $DATA['course_id'];
        $this->id_number = $DATA['id_number'];
        $this->first_name = $DATA['first_name'];
        $this->last_name = $DATA['last_name'];
        $this->middle_name = $DATA['middle_name'];
        $this->birth_date = $DATA['birth_date'];

    }
    
    public function store()
    {
        $this->validate([
            'course_id'     => '',
            'id_number'     => '',
            'first_name'    => 'required',
            'last_name'     => '',
            'middle_name'   => '',
            'birth_date'    => '',
        ]);
        
        $this->data = ([
            'course_id'     => $this->course_id,
            'id_number'     => $this->id_number,
            'first_name'    => $this->first_name,
            'last_name'     => $this->last_name,
            'middle_name'   => $this->middle_name,
            'birth_date'    => $this->birth_date,
        ]);
        
        try {
            if($this->StudentID){
                Student::find($this->StudentID)->update($this->data);
                $this->emit('alert_update');
                date_default_timezone_set('Etc/GMT-8');
                $log_data = ([
                    'user_id'       =>  Auth::user()->id,
                    'activity'      =>  'This Payor ID. '.($this->StudentID).' is successfully Updated to Student Table',
                    'created_at'    =>  date('Y-m-d H:i:s')
                ]);
                UserActivityLogsDatabase::create($log_data);
                
            }else{
                $show=Student::create($this->data);
                $this->emit('alert_store');
                date_default_timezone_set('Etc/GMT-8');
                $log_data = ([
                    'user_id'       =>  Auth::user()->id,
                    'activity'      =>  'This Payor ID. '.($show['id']).' is successfully Store to Student Table',
                    'created_at'    =>  date('Y-m-d H:i:s')
                    ]);
                UserActivityLogsDatabase::create($log_data);
                
            }
            
        } catch (\Exception $e) {
			dd($e);
			return back();
        }

        $this->emit('closeStudentModal');
        $this->emit('refresh_student_table');
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }
    
    
    public function closeStudentForm(){
        $this->emit('closeStudentModal');
        $this->emit('refresh_student_table');
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }
}

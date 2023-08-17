<?php

namespace App\Http\Livewire\AdminPanel\ManageClient;

use App\Models\Student;
use App\Models\UserActivityLogsDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StudentTable extends Component
{
    protected $listeners = [
        'refresh_student_table' => '$refresh',
        'DeleteData'
    ];
    
    public function render()
    {
        $this->emit('EmitTable');
        return view('livewire.admin-panel.manage-client.student-table',[
            'StudentData' =>  Student::all()
        ]);
    }

    public function editStudent($StudentID){
        $this->emit('openStudentModal');
        $this->emit('editStudentData',$StudentID);
    }

    public function createStudent(){
        $this->emit('openStudentModal');
    }

    public function deleteStudent($StudentID){
        $this->emit('openSwalDelete',$StudentID);
    }

    public function DeleteData($StudentID){
        Student::destroy($StudentID);
        $this->emit('EmitTable');
        $this->emit('alert_delete');
        date_default_timezone_set('Etc/GMT-8');
        $log_data = ([
            'user_id'       =>  Auth::user()->id,
            'activity'      =>  'This Payor ID. '.($StudentID).' is successfully Deleted to Student Table',
            'created_at'    =>  date('Y-m-d H:i:s')
            ]);
        UserActivityLogsDatabase::create($log_data);
    }
}

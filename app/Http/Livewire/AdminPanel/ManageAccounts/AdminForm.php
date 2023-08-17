<?php

namespace App\Http\Livewire\AdminPanel\ManageAccounts;

use App\Models\User;
use App\Models\UserActivityLogsDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdminForm extends Component
{
    public  $data = [];
    public  $name,
            $email,
            $temp_email,
            $password,
            $newpassword,
            $confirmpassword,
            $rule_id;
    public  $UserID;
    
    protected $listeners = ['editAdminData'];
    
    public function render()
    {
        return view('livewire.admin-panel.manage-accounts.admin-form');
    }

    public function editAdminData($UserID)
    {
        $this->UserID=$UserID;
        $DATA=User::find($this->UserID);
        $this->name = $DATA['name'];
        $this->email = $DATA['email'];
        $this->temp_email = $DATA['email'];

    }
    
    public function store()
    {
        if ($this->UserID) {
            if ($this->temp_email==$this->email) {
                $this->validate([
                    'name' => 'required',
                    'email' => 'required',
                    'newpassword' => 'same:confirmpassword',
                    'confirmpassword' => '',
                ]);
            } else {
                $this->validate([
                    'name' => 'required',
                    'email' => 'required|unique:users,email',
                    'newpassword' => 'same:confirmpassword',
                    'confirmpassword' => '',
                ]);
            }
        } else {
        
            $this->validate([
                'name' => 'required',
                'email' => 'required|unique:users,email',
                'password' => 'required|same:confirmpassword',
                'confirmpassword' => 'required',
            ]);
        }
        
        $this->data = ([
            'name'                      => $this->name,
            'email'                     => $this->email
        ]);

        try {
            if($this->UserID){
                if ($this->newpassword) {
                    $this->data['password']=bcrypt($this->newpassword);
                }
                User::find($this->UserID)->update($this->data);
                $this->emit('alert_update');
                date_default_timezone_set('Etc/GMT-8');
                $log_data = ([
                    'user_id'       =>  Auth::user()->id,
                    'activity'      =>  'This Admin ID. '.($this->UserID).' is successfully Updated to Admin Table',
                    'created_at'    =>  date('Y-m-d H:i:s')
                ]);
                UserActivityLogsDatabase::create($log_data);
                
            }else{
                
                $this->data['password']=bcrypt($this->password);
                $this->data['rule_id']=1;
                $show=User::create($this->data);
                $this->emit('alert_store');
                date_default_timezone_set('Etc/GMT-8');
                $log_data = ([
                    'user_id'       =>  Auth::user()->id,
                    'activity'      =>  'This Admin ID. '.($show['id']).' is successfully Store to Admin Table',
                    'created_at'    =>  date('Y-m-d H:i:s')
                    ]);
                UserActivityLogsDatabase::create($log_data);
                
            }
            
        } catch (\Exception $e) {
			dd($e);
			return back();
        }

        $this->emit('closeAdminModal');
        $this->emit('refresh_admin_table');
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }
    
    
    public function closeAdminForm(){
        $this->emit('closeAdminModal');
        $this->emit('refresh_admin_table');
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }
}

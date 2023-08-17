<?php

namespace App\Http\Livewire\AdminPanel\ManageAccounts;

use App\Models\User;
use App\Models\UserActivityLogsDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdminTable extends Component
{
    protected $listeners = [
        'refresh_admin_table' => '$refresh',
        'DeleteData'
    ];
    
    public function render()
    {
        $this->emit('EmitTable');
        return view('livewire.admin-panel.manage-accounts.admin-table',[
            'AdminData' =>  User::all()->where('rule_id',1)->whereNotIn('id',Auth::user()->id)
        ]);
    }

    public function editAdmin($UserID){
        $this->emit('openAdminModal');
        $this->emit('editAdminData',$UserID);
    }

    public function createAdmin(){
        $this->emit('openAdminModal');
    }

    public function deleteAdmin($UserID){
        $this->emit('openSwalDelete',$UserID);
    }

    public function DeleteData($UserID){
        User::destroy($UserID);
        $this->emit('EmitTable');
        $this->emit('alert_delete');
        date_default_timezone_set('Etc/GMT-8');
        $log_data = ([
            'user_id'       =>  Auth::user()->id,
            'activity'      =>  'This Admin ID. '.($UserID).' is successfully Deleted to Admin Table',
            'created_at'    =>  date('Y-m-d H:i:s')
            ]);
        UserActivityLogsDatabase::create($log_data);
    }
}

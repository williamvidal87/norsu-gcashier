<?php

namespace App\Http\Livewire\AdminPanel\ManageAccounts;

use App\Models\User;
use App\Models\UserActivityLogsDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CashierTable extends Component
{
    protected $listeners = [
        'refresh_admin_table' => '$refresh',
        'DeleteData'
    ];
    
    public function render()
    {
        $this->emit('EmitTable');
        return view('livewire.admin-panel.manage-accounts.cashier-table',[
            'CashierData' =>  User::all()->where('rule_id',2)->whereNotIn('id',Auth::user()->id)
        ]);
    }

    public function editCashier($UserID){
        $this->emit('openCashierModal');
        $this->emit('editCashierData',$UserID);
    }

    public function createCashier(){
        $this->emit('openCashierModal');
    }

    public function deleteCashier($UserID){
        $this->emit('openSwalDelete',$UserID);
    }

    public function DeleteData($UserID){
        User::destroy($UserID);
        $this->emit('EmitTable');
        $this->emit('alert_delete');
        date_default_timezone_set('Etc/GMT-8');
        $log_data = ([
            'user_id'       =>  Auth::user()->id,
            'activity'      =>  'This Cashier ID. '.($UserID).' is successfully Deleted to Cashier Table',
            'created_at'    =>  date('Y-m-d H:i:s')
            ]);
        UserActivityLogsDatabase::create($log_data);
    }
}

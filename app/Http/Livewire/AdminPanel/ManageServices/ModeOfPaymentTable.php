<?php

namespace App\Http\Livewire\AdminPanel\ManageServices;

use App\Models\ModeOfPayment;
use App\Models\UserActivityLogsDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ModeOfPaymentTable extends Component
{
    protected $listeners = [
        'refresh_modeofpayment_table' => '$refresh',
        'DeleteData'
    ];
    
    public function render()
    {
        $this->emit('EmitTable');
        return view('livewire.admin-panel.manage-services.mode-of-payment-table',[
            'ModeOfPaymentData' =>  ModeOfPayment::all()
        ]);
    }

    public function editModeOfPayment($ModeOfPaymentID){
        $this->emit('openModeOfPaymentModal');
        $this->emit('editModeOfPaymentData',$ModeOfPaymentID);
    }

    public function createModeOfPayment(){
        $this->emit('openModeOfPaymentModal');
    }

    public function deleteModeOfPayment($ModeOfPaymentID){
        $this->emit('openSwalDelete',$ModeOfPaymentID);
    }

    public function DeleteData($ModeOfPaymentID){
        ModeOfPayment::destroy($ModeOfPaymentID);
        $this->emit('EmitTable');
        $this->emit('alert_delete');
        date_default_timezone_set('Etc/GMT-8');
        $log_data = ([
            'user_id'       =>  Auth::user()->id,
            'activity'      =>  'This Mode Of Payment ID. '.($ModeOfPaymentID).' is successfully Deleted to Mode Of Payment Table',
            'created_at'    =>  date('Y-m-d H:i:s')
            ]);
        UserActivityLogsDatabase::create($log_data);
    }
}

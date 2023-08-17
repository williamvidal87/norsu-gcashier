<?php

namespace App\Http\Livewire\AdminPanel\ManageServices;

use App\Models\ModeOfPayment;
use App\Models\UserActivityLogsDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ModeOfPaymentForm extends Component
{
    public  $data = [];
    public  $mode_of_payment_name;
    public  $ModeOfPaymentID;
    
    protected $listeners = ['editModeOfPaymentData'];
    
    public function render()
    {
        return view('livewire.admin-panel.manage-services.mode-of-payment-form');
    }

    public function editModeOfPaymentData($ModeOfPaymentID)
    {
        $this->ModeOfPaymentID=$ModeOfPaymentID;
        $DATA=ModeOfPayment::find($this->ModeOfPaymentID);
        $this->mode_of_payment_name = $DATA['mode_of_payment_name'];

    }
    
    public function store()
    {
        $this->validate([
            'mode_of_payment_name'     => 'required'
        ]);
        
        $this->data = ([
            'mode_of_payment_name'     => $this->mode_of_payment_name
        ]);
        
        try {
            if($this->ModeOfPaymentID){
                ModeOfPayment::find($this->ModeOfPaymentID)->update($this->data);
                $this->emit('alert_update');
                date_default_timezone_set('Etc/GMT-8');
                $log_data = ([
                    'user_id'       =>  Auth::user()->id,
                    'activity'      =>  'This Mode Of Payment ID. '.($this->ModeOfPaymentID).' is successfully Updated to Mode Of Payment Table',
                    'created_at'    =>  date('Y-m-d H:i:s')
                ]);
                UserActivityLogsDatabase::create($log_data);
                
            }else{
                $show=ModeOfPayment::create($this->data);
                $this->emit('alert_store');
                date_default_timezone_set('Etc/GMT-8');
                $log_data = ([
                    'user_id'       =>  Auth::user()->id,
                    'activity'      =>  'This Mode Of Payment ID. '.($show['id']).' is successfully Store to Mode Of Payment Table',
                    'created_at'    =>  date('Y-m-d H:i:s')
                    ]);
                UserActivityLogsDatabase::create($log_data);
                
            }
            
        } catch (\Exception $e) {
			dd($e);
			return back();
        }

        $this->emit('closeModeOfPaymentModal');
        $this->emit('refresh_modeofpayment_table');
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }
    
    
    public function closeModeOfPaymentForm(){
        $this->emit('closeModeOfPaymentModal');
        $this->emit('refresh_modeofpayment_table');
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }
}

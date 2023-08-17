<?php

namespace App\Http\Livewire\AdminPanel\ManageServices;

use App\Models\PaymentDetail;
use App\Models\UserActivityLogsDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PaymentDetailTable extends Component
{
    protected $listeners = [
        'refresh_paymentdetail_table' => '$refresh',
        'DeleteData'
    ];
    
    public function render()
    {
        $this->emit('EmitTable');
        return view('livewire.admin-panel.manage-services.payment-detail-table',[
            'PaymentDetailData' =>  PaymentDetail::all()
        ])->with('getPaymentCategories');
    }

    public function editPaymentDetail($PaymentDetailID){
        $this->emit('openPaymentDetailModal');
        $this->emit('editPaymentDetailData',$PaymentDetailID);
    }

    public function createPaymentDetail(){
        $this->emit('openPaymentDetailModal');
    }

    public function deletePaymentDetail($PaymentDetailID){
        $this->emit('openSwalDelete',$PaymentDetailID);
    }

    public function DeleteData($PaymentDetailID){
        PaymentDetail::destroy($PaymentDetailID);
        $this->emit('EmitTable');
        $this->emit('alert_delete');
        date_default_timezone_set('Etc/GMT-8');
        $log_data = ([
            'user_id'       =>  Auth::user()->id,
            'activity'      =>  'This Payment Detail ID. '.($PaymentDetailID).' is successfully Deleted to Payment Details Table',
            'created_at'    =>  date('Y-m-d H:i:s')
            ]);
        UserActivityLogsDatabase::create($log_data);
    }
}

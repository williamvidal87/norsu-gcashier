<?php

namespace App\Http\Livewire\AdminPanel\ManageServices;

use App\Models\PaymentCategories;
use App\Models\PaymentDetail;
use App\Models\UserActivityLogsDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PaymentDetailForm extends Component
{
    public  $data = [];
    public  $payment_categories_id,
            $payment_detail_name,
            $purpose,
            $price;
    public  $PaymentDetailID;

    protected $listeners = ['editPaymentDetailData'];

    public function render()
    {
        return view('livewire.admin-panel.manage-services.payment-detail-form',[
            'PaymentCategories_Data' =>  PaymentCategories::all()
        ]);
    }

    public function editPaymentDetailData($PaymentDetailID)
    {
        $this->PaymentDetailID=$PaymentDetailID;
        $DATA=PaymentDetail::find($this->PaymentDetailID);
        $this->payment_categories_id    = $DATA['payment_categories_id'];
        $this->payment_detail_name      = $DATA['payment_detail_name'];
        $this->purpose                  = $DATA['purpose'];
        $this->price                    = $DATA['price'];

    }

    public function store()
    {
        $this->validate([
            'payment_categories_id' => 'required',
            'payment_detail_name'   => 'required',
            'purpose'               => '',
            'price'                 => ''
        ]);

        $this->data = ([
            'payment_categories_id' => $this->payment_categories_id,
            'payment_detail_name'   => $this->payment_detail_name,
            'purpose'               => $this->purpose,
            'price'                 => $this->price
        ]);

        if ($this->price=='') {
            $this->data['price']=null;
        }

        try {
            if($this->PaymentDetailID){
                PaymentDetail::find($this->PaymentDetailID)->update($this->data);
                $this->emit('alert_update');
                date_default_timezone_set('Etc/GMT-8');
                $log_data = ([
                    'user_id'       =>  Auth::user()->id,
                    'activity'      =>  'This Payment Detail ID. '.($this->PaymentDetailID).' is successfully Updated to Payment Details Table',
                    'created_at'    =>  date('Y-m-d H:i:s')
                ]);
                UserActivityLogsDatabase::create($log_data);

            }else{
                $show=PaymentDetail::create($this->data);
                $this->emit('alert_store');
                date_default_timezone_set('Etc/GMT-8');
                $log_data = ([
                    'user_id'       =>  Auth::user()->id,
                    'activity'      =>  'This Payment Detail ID. '.($show['id']).' is successfully Store to Payment Details Table',
                    'created_at'    =>  date('Y-m-d H:i:s')
                    ]);
                UserActivityLogsDatabase::create($log_data);

            }

        } catch (\Exception $e) {
			dd($e);
			return back();
        }

        $this->emit('closePaymentDetailModal');
        $this->emit('refresh_paymentdetail_table');
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }


    public function closePaymentDetailForm(){
        $this->emit('closePaymentDetailModal');
        $this->emit('refresh_paymentdetail_table');
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }
}

<?php

namespace App\Http\Livewire\AdminPanel\Extras;

use App\Models\PaymentCategories;
use App\Models\UserActivityLogsDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PaymentCategoryForm extends Component
{
    public  $data = [];
    public  $payment_categories_name;
    public  $PaymentCategoryID;
    
    protected $listeners = ['editPaymentCategoryData'];
    
    public function render()
    {
        return view('livewire.admin-panel.extras.payment-category-form');
    }

    public function editPaymentCategoryData($PaymentCategoryID)
    {
        $this->PaymentCategoryID=$PaymentCategoryID;
        $DATA=PaymentCategories::find($this->PaymentCategoryID);
        $this->payment_categories_name = $DATA['payment_categories_name'];

    }
    
    public function store()
    {
        $this->validate([
            'payment_categories_name'     => 'required',
        ]);
        
        $this->data = ([
            'payment_categories_name'     => $this->payment_categories_name
        ]);
        
        try {
            if($this->PaymentCategoryID){
                PaymentCategories::find($this->PaymentCategoryID)->update($this->data);
                $this->emit('alert_update');
                date_default_timezone_set('Etc/GMT-8');
                $log_data = ([
                    'user_id'       =>  Auth::user()->id,
                    'activity'      =>  'This Payment Category ID. '.($this->PaymentCategoryID).' is successfully Updated to Payment Categories Table',
                    'created_at'    =>  date('Y-m-d H:i:s')
                ]);
                UserActivityLogsDatabase::create($log_data);
                
            }else{
                $show=PaymentCategories::create($this->data);
                $this->emit('alert_store');
                date_default_timezone_set('Etc/GMT-8');
                $log_data = ([
                    'user_id'       =>  Auth::user()->id,
                    'activity'      =>  'This Payment Category ID. '.($show['id']).' is successfully Store to Payment Categories Table',
                    'created_at'    =>  date('Y-m-d H:i:s')
                    ]);
                UserActivityLogsDatabase::create($log_data);
                
            }
            
        } catch (\Exception $e) {
			dd($e);
			return back();
        }

        $this->emit('closePaymentCategoryModal');
        $this->emit('refresh_paymentcategory_table');
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }
    
    
    public function closePaymentCategoryForm(){
        $this->emit('closePaymentCategoryModal');
        $this->emit('refresh_paymentcategory_table');
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }
}

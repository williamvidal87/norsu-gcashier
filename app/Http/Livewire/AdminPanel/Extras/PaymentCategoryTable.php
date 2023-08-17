<?php

namespace App\Http\Livewire\AdminPanel\Extras;

use App\Models\PaymentCategories;
use App\Models\UserActivityLogsDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PaymentCategoryTable extends Component
{
    protected $listeners = [
        'refresh_paymentcategory_table' => '$refresh',
        'DeleteData'
    ];
    
    public function render()
    {
        $this->emit('EmitTable');
        return view('livewire.admin-panel.extras.payment-category-table',[
            'PaymentCategoryData' =>  PaymentCategories::all()
        ]);
    }

    public function editPaymentCategory($PaymentCategoryID){
        $this->emit('openPaymentCategoryModal');
        $this->emit('editPaymentCategoryData',$PaymentCategoryID);
    }

    public function createPaymentCategory(){
        $this->emit('openPaymentCategoryModal');
    }

    public function deletePaymentCategory($PaymentCategoryID){
        $this->emit('openSwalDelete',$PaymentCategoryID);
    }

    public function DeleteData($PaymentCategoryID){
        PaymentCategories::destroy($PaymentCategoryID);
        $this->emit('EmitTable');
        $this->emit('alert_delete');
        date_default_timezone_set('Etc/GMT-8');
        $log_data = ([
            'user_id'       =>  Auth::user()->id,
            'activity'      =>  'This Payment Category ID. '.($PaymentCategoryID).' is successfully Deleted to Payment Categories Table',
            'created_at'    =>  date('Y-m-d H:i:s')
            ]);
        UserActivityLogsDatabase::create($log_data);
    }
}

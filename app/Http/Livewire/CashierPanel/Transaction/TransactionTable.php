<?php

namespace App\Http\Livewire\CashierPanel\Transaction;

use App\Models\Transaction;
use App\Models\TransactionPayment;
use App\Models\UserActivityLogsDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TransactionTable extends Component
{
    protected $listeners = [
        'refresh_transaction_table' => '$refresh',
        'DeleteData'
    ];
    
    public function render()
    {
        $this->emit('EmitTable');
        date_default_timezone_set('Asia/Manila');
        $month= date('Y-m-d');
        $selected_date = date("Y-m-d", strtotime($month . "-30 days"));
        return view('livewire.cashier-panel.transaction.transaction-table',[
            'TransactionData' =>  Transaction::where('cashier_id',Auth::user()->id)->whereDate('created_at', '>=', $selected_date)->get(),
            'TransactionPaymentData' =>  TransactionPayment::whereDate('created_at', '>=', $selected_date)->get()
        ])->with('getStudent','getPaymentDetail','getModeOfPayment');
    }

    public function editTransaction($TransactionID){
        $this->emit('openTransactionModal');
        $this->emit('editTransactionData',$TransactionID);
    }

    public function viewTransaction($TransactionID){
        $this->emit('openViewTransactionModal');
        $this->emit('viewTransactionData',$TransactionID);
    }

    public function createTransaction(){
        $this->emit('openTransactionModal');
    }

    public function deleteTransaction($TransactionID){
        $this->emit('openSwalDelete',$TransactionID);
    }

    public function DeleteData($TransactionID){
        Transaction::destroy($TransactionID);
        $this->emit('EmitTable');
        $this->emit('alert_delete');
        date_default_timezone_set('Etc/GMT-8');
        $log_data = ([
            'user_id'       =>  Auth::user()->id,
            'activity'      =>  'This Transaction ID. TR'.(24160+$TransactionID).' is successfully Deleted to Transaction Table',
            'created_at'    =>  date('Y-m-d H:i:s')
            ]);
        UserActivityLogsDatabase::create($log_data);
    }
}

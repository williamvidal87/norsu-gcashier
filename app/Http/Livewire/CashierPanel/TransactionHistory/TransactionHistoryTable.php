<?php

namespace App\Http\Livewire\CashierPanel\TransactionHistory;

use App\Models\Transaction;
use App\Models\TransactionPayment;
use App\Models\UserActivityLogsDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TransactionHistoryTable extends Component
{
    protected $listeners = [
        'refresh_transaction_table' => '$refresh',
        'DeleteData'
    ];
    
    public function render()
    {
        $this->emit('EmitTable');
        date_default_timezone_set('Asia/Manila');
        $month= date('m') ;
        return view('livewire.cashier-panel.transaction-history.transaction-history-table',[
            'TransactionData' =>  Transaction::where('cashier_id',Auth::user()->id)->get(),
            'TransactionPaymentData' =>  TransactionPayment::all()
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

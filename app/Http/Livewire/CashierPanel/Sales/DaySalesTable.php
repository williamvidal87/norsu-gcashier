<?php

namespace App\Http\Livewire\CashierPanel\Sales;

use App\Models\Transaction;
use App\Models\TransactionPayment;
use Livewire\Component;

class DaySalesTable extends Component
{
    public $date;
    
    protected $listeners = [
        'refresh_daysales_table' => '$refresh'
    ];
    
    public function render()
    {
        $this->emit('EmitTable');
        return view('livewire.cashier-panel.sales.day-sales-table',[
            'TransactionData' =>  Transaction::whereDate('date', '=', $this->date)->get(),
            'TransactionPaymentData' =>  TransactionPayment::all()
        ])->with('getStudent','getModeOfPayment','getCashier');
    }
    
    public function mount()
    {
        date_default_timezone_set('Asia/Manila');
        $this->date= date('Y-m-d');
        
    }
    
    public function selectdate()
    {
        $this->emit('refresh_daysales_table');
    }
}

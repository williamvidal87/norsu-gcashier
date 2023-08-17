<?php

namespace App\Http\Livewire\AdminPanel\ManageReport;

use App\Models\Transaction;
use App\Models\TransactionPayment;
use Livewire\Component;

class DailyReportTable extends Component
{
    public $date;
    
    protected $listeners = [
        'refresh_daily_report_table' => '$refresh'
    ];
    
    public function render()
    {
        $this->emit('EmitTable');
        return view('livewire.admin-panel.manage-report.daily-report-table',[
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
        $this->emit('refresh_daily_report_table');
    }
}

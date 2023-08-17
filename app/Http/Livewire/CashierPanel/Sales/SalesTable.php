<?php

namespace App\Http\Livewire\CashierPanel\Sales;

use App\Models\ModeOfPayment;
use App\Models\PaymentCategories;
use App\Models\Student;
use App\Models\Transaction;
use App\Models\TransactionPayment;
use App\Models\User;
use Livewire\Component;

class SalesTable extends Component
{
    public $data=[];
    public $transaction_id=[];
    public $receipt_no=[];
    public $cashier_id=[];
    public $student_id=[];
    public $mode_of_payment_id=[];
    public $payment_categories_id=[];
    public $total_sales=[];
    public $transaction_category=[];
    public $status_id=[];
    public $count=0;
    
    
    public function render()
    {
        return view('livewire.cashier-panel.sales.sales-table',[
            'ManageReportData' =>  $this->data,
            'UserData' => User::all(),
            'StudentData' => Student::all(),
            'ModeOfPaymentData' => ModeOfPayment::all(),
            'PaymentCategoriesData' => PaymentCategories::all()
        ])->with('getPaymentCategory');
    }
    
    public function mount()
    {
    //transaction_category
        $ManageReportData=TransactionPayment::select('transaction_category')->distinct()->get();
        foreach ($ManageReportData as $managereportdata) {
            $Find=TransactionPayment::where('transaction_category',$managereportdata['transaction_category'])->get();
            foreach ($Find as $find) {
            }
            $Find_Transaction=Transaction::where('id',$find['transaction_id'])->get();
            foreach ($Find_Transaction as $find_transaction) {
            }
            $Total_Sales=TransactionPayment::whereIn('transaction_category',[$managereportdata['transaction_category']])->get();
            $total_add=0;
            foreach ($Total_Sales as $total_sales) {
                $total_add+=$total_sales['qty']*$total_sales['price'];
            }
            
            $this->data[$this->count++]=[
            'id'=>$find['id'],
            'transaction_id'=>$find['transaction_id'],
            'receipt_no'=>$find_transaction['receipt_no'],
            'cashier_id'=>$find_transaction['cashier_id'],
            'student_id'=>$find_transaction['student_id'],
            'mode_of_payment_id'=>$find_transaction['mode_of_payment_id'],
            'payment_categories_id'=>$find['payment_categories_id'],
            'total_sales'=>$total_add,
            'created_at'=>$find_transaction['created_at']->format('Y-m-d'),
            'status_id'=>$find_transaction['status_id']
            ];
            
        }
        // dd($this->data);
    }
}

<?php

namespace App\Http\Livewire\CashierPanel\Transaction;

use App\Models\ModeOfPayment;
use App\Models\PaymentCategories;
use App\Models\PaymentDetail;
use App\Models\Student;
use App\Models\Transaction;
use App\Models\TransactionPayment;
use App\Models\User;
use App\Models\UserActivityLogsDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use PDF;
use NumberToWords\NumberToWords;

class TransactionForm extends Component
{
    public  $data = [];
    public  $receipt_no,
            $payor_name,
            $mode_of_payment_id,
            $date;
    public  $TransactionID;
    public  $orderProducts = [];
    public  $payment_categories_id = [];
    public  $payment_detail_id = [];
    public  $qty = [];
    public  $price = [];
    public  $total_all = 0;
    
    protected $listeners = [
    'editTransactionData'
    ];
    
    public function addProduct()
    {
        $this->orderProducts[] = ['id'=>'','transaction_id' => '','payment_categories_id'=>'', 'payment_detail_id' => '', 'qty' => '1', 'price' => ''];
    }

    public function removeProduct($index)
    {   
        unset($this->orderProducts[$index]);
        $this->orderProducts = array_values($this->orderProducts);
    }
    
    public function render()
    {
        return view('livewire.cashier-panel.transaction.transaction-form',[
            'StudentData' =>  Student::orderBy('last_name', 'ASC')->get(),
            'ModeOfPaymentData' =>  ModeOfPayment::orderBy('mode_of_payment_name', 'ASC')->get(),
            'PaymentCategoriesData' =>  PaymentCategories::orderBy('payment_categories_name', 'ASC')->get(),
            'PaymentDetailData' =>  PaymentDetail::orderBy('payment_detail_name', 'ASC')->get()
        ]);
    }
    
    public function ResetDetails($index)
    {
        $this->orderProducts[$index]['payment_detail_id']=null;
        $this->orderProducts[$index]['price']=null;
    }
    
    public function hydrate(){
        $this->emit('select2');
    }

    public function editTransactionData($TransactionID)
    {
        $this->TransactionID=$TransactionID;
        $DATA=Transaction::find($this->TransactionID);
        $this->receipt_no           = $DATA['receipt_no'];
        $this->payor_name           = $DATA['payor_name'];
        $this->mode_of_payment_id   = $DATA['mode_of_payment_id'];
        $this->date                 = $DATA['date'];
        
        $transactionpayments = TransactionPayment::all()->where('transaction_id', $this->TransactionID);
        $count_transaction=0;
        foreach ($transactionpayments as $transactionpayment) {
            $this->orderProducts[$count_transaction++] = ['id'=>$transactionpayment['id'],'transaction_id'=>$transactionpayment['transaction_id'],'payment_categories_id' => $transactionpayment['payment_categories_id'], 'payment_detail_id' => $transactionpayment['payment_detail_id'], 'qty' => $transactionpayment['qty'], 'price' => $transactionpayment['price']];
        }

    }
    
    public function store()
    {
        
        $this->data = ([
            'receipt_no'            => $this->receipt_no,
            'payor_name'            => $this->payor_name,
            'mode_of_payment_id'    => $this->mode_of_payment_id,
            'cashier_id'            => Auth::user()->id,
            'date'                  => $this->date,
        ]);
        
        
        $this->validate([
            'receipt_no'            => 'required||max:7||min:7',
            'payor_name'            => 'required',
            'mode_of_payment_id'    => 'required',
            'date'                  => 'required',
            'orderProducts'     => 'array|required',
            'orderProducts.*.payment_categories_id'     => 'required',
            'orderProducts.*.payment_detail_id'            => 'required',
            'orderProducts.*.qty'                     => 'required',
        ]);
        
        try {
            if($this->TransactionID){
                Transaction::find($this->TransactionID)->update($this->data);
                
                TransactionPayment::where('transaction_id', $this->TransactionID)->delete(); // Delete all
                // Copying TransactionID to TransactioPayment
                for ($i=0; $i < count($this->orderProducts); $i++) {
                    $this->orderProducts[$i]['transaction_id']=$this->TransactionID;
                    $this->orderProducts[$i]['transaction_category']=$this->TransactionID.$this->orderProducts[$i]['payment_categories_id'];
                }
                foreach ($this->orderProducts as $orderproducts) {
                    TransactionPayment::create($orderproducts);
                }
                
                $this->emit('alert_update');
                date_default_timezone_set('Etc/GMT-8');
                $log_data = ([
                    'user_id'       =>  Auth::user()->id,
                    'activity'      =>  'This Transaction ID. TR'.(24160+$this->TransactionID).' is successfully Updated to Transaction Table',
                    'created_at'    =>  date('Y-m-d H:i:s')
                ]);
                UserActivityLogsDatabase::create($log_data);
                
            }else{
                $show=Transaction::create($this->data);
                
                // Copying TransactionID to TransactioPayment
                for ($i=0; $i < count($this->orderProducts); $i++) {
                    $this->orderProducts[$i]['transaction_id']=$show['id'];
                    $this->orderProducts[$i]['transaction_category']=$show['id'].$this->orderProducts[$i]['payment_categories_id'];
                }
                
                foreach ($this->orderProducts as $orderproducts) {
                    TransactionPayment::create($orderproducts);
                }
                
                $this->emit('alert_store');
                date_default_timezone_set('Etc/GMT-8');
                $log_data = ([
                    'user_id'       =>  Auth::user()->id,
                    'activity'      =>  'This Transaction ID. TR'.(24160+$show['id']).' is successfully Store to Transaction Table',
                    'created_at'    =>  date('Y-m-d H:i:s')
                    ]);
                UserActivityLogsDatabase::create($log_data);
                
                $this->emit('closeTransactionModal');
                $this->emit('refresh_transaction_table');
                $this->resetErrorBag();
                $this->resetValidation();
                
                $Collecting_Officer = User::find(1);
                $this->reset();
                $pdfContent = PDF::loadView('livewire.cashier-panel.transaction.transaction-receipt',[
                    'StudentData' =>  Student::all(),
                    'ModeOfPayment' =>  $show['mode_of_payment_id'],
                    'PaymentCategoriesData' =>  PaymentCategories::all(),
                    'PaymentDetailData' =>  PaymentDetail::all(),
                    'TransactionID' =>  $show['id'],
                    'Date' =>  date('m/d/Y', strtotime($show['date'])),
                    'StudentName' =>  $show['payor_name'],
                    'TransactionPayment' =>  TransactionPayment::all()->where('transaction_id', $show['id']),
                    'total' => 0,
                    'Collecting_Officer' => $Collecting_Officer['name'],
                    'numberToWords' => new NumberToWords()
                ])->setPaper('Letter', 'Portrait')->output();
                return response()->streamDownload(fn () => print($pdfContent),$show['payor_name']."_Receipt.pdf");
                
            }
            
        } catch (\Exception $e) {
			dd($e);
			return back();
        }
        
        $this->emit('closeTransactionModal');
        $this->emit('refresh_transaction_table');
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }
    
    
    public function closeTransactionForm(){
        $this->emit('closeTransactionModal');
        $this->emit('refresh_transaction_table');
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }
}

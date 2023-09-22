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

class TransactionView extends Component
{
    public  $data = [];
    public  $receipt_no,
            $payor_name,
            $mode_of_payment_id,
            $remark,
            $status_id,
            $check_bank,
            $check_number,
            $check_date,
            $note;
    public  $TransactionID;
    public  $orderProducts = [];
    public  $payment_categories_id = [];
    public  $payment_detail_id = [];
    public  $qty = [];
    public  $price = [];
    public  $total_all = 0;
    public  $Date;

    protected $listeners = [
    'viewTransactionData',
    'RemarkName'
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
        return view('livewire.cashier-panel.transaction.transaction-view',[
            'StudentData' =>  Student::all(),
            'ModeOfPaymentData' =>  ModeOfPayment::all(),
            'PaymentCategoriesData' =>  PaymentCategories::all(),
            'PaymentDetailData' =>  PaymentDetail::all()
        ]);
    }

    public function RemarkName($remark)
    {
        $data = ([
            'remark'            => $remark,
            'status_id'         => 1
        ]);
        Transaction::find($this->TransactionID)->update($data);
        $this->emit('alert_cancel');
        date_default_timezone_set('Etc/GMT-8');
        $log_data = ([
            'user_id'       =>  Auth::user()->id,
            'activity'      =>  'This Transaction ID. TR'.(24160+$this->TransactionID).' is successfully Cancelled to Transaction Table',
            'created_at'    =>  date('Y-m-d H:i:s')
        ]);
        UserActivityLogsDatabase::create($log_data);

        $this->emit('closeremarkModal');
        $this->emit('closeViewTransactionModal');
        $this->emit('refresh_transaction_table');
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function CancelTransaction()
    {
        $this->emit('openremarkModal');
    }

    public function viewTransactionData($TransactionID)
    {
        $this->TransactionID=$TransactionID;
        $DATA=Transaction::find($this->TransactionID);
        $this->receipt_no           = $DATA['receipt_no'];
        $this->payor_name           = $DATA['payor_name'];
        $this->mode_of_payment_id   = $DATA['mode_of_payment_id'];
        $this->Date                 = date('m/d/Y', strtotime($DATA['date']));
        $this->remark               = $DATA['remark'];
        $this->status_id            = $DATA['status_id'];
        $this->check_bank           = $DATA['check_bank'];
        $this->check_number         = $DATA['check_number'];
        $this->check_date           = $DATA['check_date'];
        $this->note                 = $DATA['note'];

        $transactionpayments = TransactionPayment::all()->where('transaction_id', $this->TransactionID);
        $count_transaction=0;
        foreach ($transactionpayments as $transactionpayment) {
            $this->orderProducts[$count_transaction++] = ['id'=>$transactionpayment['id'],'transaction_id'=>$transactionpayment['transaction_id'],'payment_categories_id' => $transactionpayment['payment_categories_id'], 'payment_detail_id' => $transactionpayment['payment_detail_id'], 'qty' => $transactionpayment['qty'], 'price' => $transactionpayment['price']];
        }

    }


    public function closeTransactionViewForm(){
        $this->emit('closeViewTransactionModal');
        $this->emit('refresh_transaction_table');
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }


    public function PrintTransactionReceipt(){
        $Check = Transaction::find($this->TransactionID);
        $Collecting_Officer = User::find(1);
        $this->emit('closeViewTransactionModal');
        $this->emit('refresh_transaction_table');
        $pdfContent = PDF::loadView('livewire.cashier-panel.transaction.transaction-receipt',[
            'StudentData' =>  Student::all(),
            'ModeOfPayment' =>  $Check['mode_of_payment_id'],
            'PaymentCategoriesData' =>  PaymentCategories::all(),
            'PaymentDetailData' =>  PaymentDetail::all(),
            'TransactionID' =>  $this->TransactionID,
            'Date' =>  date('m/d/Y', strtotime($Check['date'])),
            'StudentName' =>  $this->payor_name,
            'TransactionPayment' =>  TransactionPayment::all()->where('transaction_id', $this->TransactionID),
            'total' => 0,
            'Collecting_Officer' => $Collecting_Officer['name'],
            'numberToWords' => new NumberToWords(),
            'check_bank' => $this->check_bank,
            'check_number' => $this->check_number,
            'check_date' => date('m/d/Y', strtotime($this->check_date)),
            'note' => $this->note,
        ])->setPaper('Letter', 'Portrait')->output();
        return response()->streamDownload(fn () => print($pdfContent),$this->payor_name."_Receipt.pdf");
    }
}

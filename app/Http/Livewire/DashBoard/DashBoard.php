<?php

namespace App\Http\Livewire\DashBoard;

use App\Models\Transaction;
use App\Models\TransactionPayment;
use Livewire\Component;

class DashBoard extends Component
{
    public $M63=0;
    public $M64=0;
    public $T64=0;
    public $date;
    public  $jan=0,
            $feb=0,
            $mar=0,
            $apr=0,
            $may=0,
            $jun=0,
            $jul=0,
            $aug=0,
            $sep=0,
            $oct=0,
            $nov=0,
            $dec=0;
    public  $total_M163=0,
            $total_M164=0,
            $total_T164=0;
    
    public function render()
    {
        return view('livewire.dash-board.dash-board');
    }
    
    public function mount()
    {
        
        date_default_timezone_set('Asia/Manila');
        $this->date= date('Y-m-d');
        $show_transaction_id=Transaction::whereDate('date', '=', $this->date)->get();
        foreach ($show_transaction_id as $transaction_id) {
            if($transaction_id['status_id']!=1)
            {
                $show_transaction_payment_id=TransactionPayment::where('transaction_id',$transaction_id['id'])->get();
                foreach ($show_transaction_payment_id as $transaction_payment_id) {
                    if($transaction_payment_id['payment_categories_id']==3)
                    {
                        $this->M63+=$transaction_payment_id['price']*$transaction_payment_id['qty'];
                    }
                    if($transaction_payment_id['payment_categories_id']==2)
                    {
                        $this->M64+=$transaction_payment_id['price']*$transaction_payment_id['qty'];
                    }
                    if($transaction_payment_id['payment_categories_id']==1)
                    {
                        $this->T64+=$transaction_payment_id['price']*$transaction_payment_id['qty'];
                    }
                }
            }
        }
        
        //for chart area data
        $chart_year= date('Y');
        $jan='1';
        $feb='2';
        $mar='3';
        $apr='4';
        $may='5';
        $jun='6';
        $jul='7';
        $aug='8';
        $sep='9';
        $oct='11';
        $nov='10';
        $dec='12';
        //jan
        $jan_transaction_id=Transaction::whereMonth('date', '=', $jan)->whereYear('date', '=', $chart_year)->get();
        foreach ($jan_transaction_id as $jan_transaction) {
            if($jan_transaction['status_id']!=1)
            {
                $jan_payment_id=TransactionPayment::where('transaction_id',$jan_transaction['id'])->get();
                foreach ($jan_payment_id as $jan_payment) {
                    if($jan_payment['payment_categories_id']==3)
                    {
                        $this->jan+=$jan_payment['price']*$jan_payment['qty'];
                        $this->total_M163+=$jan_payment['price']*$jan_payment['qty'];
                    }
                    if($jan_payment['payment_categories_id']==2)
                    {
                        $this->jan+=$jan_payment['price']*$jan_payment['qty'];
                        $this->total_M164+=$jan_payment['price']*$jan_payment['qty'];
                    }
                    if($jan_payment['payment_categories_id']==1)
                    {
                        $this->jan+=$jan_payment['price']*$jan_payment['qty'];
                        $this->total_T164+=$jan_payment['price']*$jan_payment['qty'];
                    }
                }
            }
        }
        //feb
        $feb_transaction_id=Transaction::whereMonth('date', '=', $feb)->whereYear('date', '=', $chart_year)->get();
        foreach ($feb_transaction_id as $feb_transaction) {
            if($feb_transaction['status_id']!=1)
            {
                $feb_payment_id=TransactionPayment::where('transaction_id',$feb_transaction['id'])->get();
                foreach ($feb_payment_id as $feb_payment) {
                    if($feb_payment['payment_categories_id']==3)
                    {
                        $this->feb+=$feb_payment['price']*$feb_payment['qty'];
                        $this->total_M163+=$feb_payment['price']*$feb_payment['qty'];
                    }
                    if($feb_payment['payment_categories_id']==2)
                    {
                        $this->feb+=$feb_payment['price']*$feb_payment['qty'];
                        $this->total_M164+=$feb_payment['price']*$feb_payment['qty'];
                    }
                    if($feb_payment['payment_categories_id']==1)
                    {
                        $this->feb+=$feb_payment['price']*$feb_payment['qty'];
                        $this->total_T164+=$feb_payment['price']*$feb_payment['qty'];
                    }
                }
            }
        }
        //mar
        $mar_transaction_id=Transaction::whereMonth('date', '=', $mar)->whereYear('date', '=', $chart_year)->get();
        foreach ($mar_transaction_id as $mar_transaction) {
            if($mar_transaction['status_id']!=1)
            {
                $mar_payment_id=TransactionPayment::where('transaction_id',$mar_transaction['id'])->get();
                foreach ($mar_payment_id as $mar_payment) {
                    if($mar_payment['payment_categories_id']==3)
                    {
                        $this->mar+=$mar_payment['price']*$mar_payment['qty'];
                        $this->total_M163+=$mar_payment['price']*$mar_payment['qty'];
                    }
                    if($mar_payment['payment_categories_id']==2)
                    {
                        $this->mar+=$mar_payment['price']*$mar_payment['qty'];
                        $this->total_M164+=$mar_payment['price']*$mar_payment['qty'];
                    }
                    if($mar_payment['payment_categories_id']==1)
                    {
                        $this->mar+=$mar_payment['price']*$mar_payment['qty'];
                        $this->total_T164+=$mar_payment['price']*$mar_payment['qty'];
                    }
                }
            }
        }
        //apr
        $apr_transaction_id=Transaction::whereMonth('date', '=', $apr)->whereYear('date', '=', $chart_year)->get();
        foreach ($apr_transaction_id as $apr_transaction) {
            if($apr_transaction['status_id']!=1)
            {
                $apr_payment_id=TransactionPayment::where('transaction_id',$apr_transaction['id'])->get();
                foreach ($apr_payment_id as $apr_payment) {
                    if($apr_payment['payment_categories_id']==3)
                    {
                        $this->apr+=$apr_payment['price']*$apr_payment['qty'];
                        $this->total_M163+=$apr_payment['price']*$apr_payment['qty'];
                    }
                    if($apr_payment['payment_categories_id']==2)
                    {
                        $this->apr+=$apr_payment['price']*$apr_payment['qty'];
                        $this->total_M164+=$apr_payment['price']*$apr_payment['qty'];
                    }
                    if($apr_payment['payment_categories_id']==1)
                    {
                        $this->apr+=$apr_payment['price']*$apr_payment['qty'];
                        $this->total_T164+=$apr_payment['price']*$apr_payment['qty'];
                    }
                }
            }
        }
        //may
        $may_transaction_id=Transaction::whereMonth('date', '=', $may)->whereYear('date', '=', $chart_year)->get();
        foreach ($may_transaction_id as $may_transaction) {
            if($may_transaction['status_id']!=1)
            {
                $may_payment_id=TransactionPayment::where('transaction_id',$may_transaction['id'])->get();
                foreach ($may_payment_id as $may_payment) {
                    if($may_payment['payment_categories_id']==3)
                    {
                        $this->may+=$may_payment['price']*$may_payment['qty'];
                        $this->total_M163+=$may_payment['price']*$may_payment['qty'];
                    }
                    if($may_payment['payment_categories_id']==2)
                    {
                        $this->may+=$may_payment['price']*$may_payment['qty'];
                        $this->total_M164+=$may_payment['price']*$may_payment['qty'];
                    }
                    if($may_payment['payment_categories_id']==1)
                    {
                        $this->may+=$may_payment['price']*$may_payment['qty'];
                        $this->total_T164+=$may_payment['price']*$may_payment['qty'];
                    }
                }
            }
        }
        //jun
        $jun_transaction_id=Transaction::whereMonth('date', '=', $jun)->whereYear('date', '=', $chart_year)->get();
        foreach ($jun_transaction_id as $jun_transaction) {
            if($jun_transaction['status_id']!=1)
            {
                $jun_payment_id=TransactionPayment::where('transaction_id',$jun_transaction['id'])->get();
                foreach ($jun_payment_id as $jun_payment) {
                    if($jun_payment['payment_categories_id']==3)
                    {
                        $this->jun+=$jun_payment['price']*$jun_payment['qty'];
                        $this->total_M163+=$jun_payment['price']*$jun_payment['qty'];
                    }
                    if($jun_payment['payment_categories_id']==2)
                    {
                        $this->jun+=$jun_payment['price']*$jun_payment['qty'];
                        $this->total_M164+=$jun_payment['price']*$jun_payment['qty'];
                    }
                    if($jun_payment['payment_categories_id']==1)
                    {
                        $this->jun+=$jun_payment['price']*$jun_payment['qty'];
                        $this->total_T164+=$jun_payment['price']*$jun_payment['qty'];
                    }
                }
            }
        }
        //jul
        $jul_transaction_id=Transaction::whereMonth('date', '=', $jul)->whereYear('date', '=', $chart_year)->get();
        foreach ($jul_transaction_id as $jul_transaction) {
            if($jul_transaction['status_id']!=1)
            {
                $jul_payment_id=TransactionPayment::where('transaction_id',$jul_transaction['id'])->get();
                foreach ($jul_payment_id as $jul_payment) {
                    if($jul_payment['payment_categories_id']==3)
                    {
                        $this->jul+=$jul_payment['price']*$jul_payment['qty'];
                        $this->total_M163+=$jul_payment['price']*$jul_payment['qty'];
                    }
                    if($jul_payment['payment_categories_id']==2)
                    {
                        $this->jul+=$jul_payment['price']*$jul_payment['qty'];
                        $this->total_M164+=$jul_payment['price']*$jul_payment['qty'];
                    }
                    if($jul_payment['payment_categories_id']==1)
                    {
                        $this->jul+=$jul_payment['price']*$jul_payment['qty'];
                        $this->total_T164+=$jul_payment['price']*$jul_payment['qty'];
                    }
                }
            }
        }
        //aug
        $aug_transaction_id=Transaction::whereMonth('date', '=', $aug)->whereYear('date', '=', $chart_year)->get();
        foreach ($aug_transaction_id as $aug_transaction) {
            if($aug_transaction['status_id']!=1)
            {
                $aug_payment_id=TransactionPayment::where('transaction_id',$aug_transaction['id'])->get();
                foreach ($aug_payment_id as $aug_payment) {
                    if($aug_payment['payment_categories_id']==3)
                    {
                        $this->aug+=$aug_payment['price']*$aug_payment['qty'];
                        $this->total_M163+=$aug_payment['price']*$aug_payment['qty'];
                    }
                    if($aug_payment['payment_categories_id']==2)
                    {
                        $this->aug+=$aug_payment['price']*$aug_payment['qty'];
                        $this->total_M164+=$aug_payment['price']*$aug_payment['qty'];
                    }
                    if($aug_payment['payment_categories_id']==1)
                    {
                        $this->aug+=$aug_payment['price']*$aug_payment['qty'];
                        $this->total_T164+=$aug_payment['price']*$aug_payment['qty'];
                    }
                }
            }
        }
        //sep
        $sep_transaction_id=Transaction::whereMonth('date', '=', $sep)->whereYear('date', '=', $chart_year)->get();
        foreach ($sep_transaction_id as $sep_transaction) {
            if($sep_transaction['status_id']!=1)
            {
                $sep_payment_id=TransactionPayment::where('transaction_id',$sep_transaction['id'])->get();
                foreach ($sep_payment_id as $sep_payment) {
                    if($sep_payment['payment_categories_id']==3)
                    {
                        $this->sep+=$sep_payment['price']*$sep_payment['qty'];
                        $this->total_M163+=$sep_payment['price']*$sep_payment['qty'];
                    }
                    if($sep_payment['payment_categories_id']==2)
                    {
                        $this->sep+=$sep_payment['price']*$sep_payment['qty'];
                        $this->total_M164+=$sep_payment['price']*$sep_payment['qty'];
                    }
                    if($sep_payment['payment_categories_id']==1)
                    {
                        $this->sep+=$sep_payment['price']*$sep_payment['qty'];
                        $this->total_T164+=$sep_payment['price']*$sep_payment['qty'];
                    }
                }
            }
        }
        //oct
        $oct_transaction_id=Transaction::whereMonth('date', '=', $oct)->whereYear('date', '=', $chart_year)->get();
        foreach ($oct_transaction_id as $oct_transaction) {
            if($oct_transaction['status_id']!=1)
            {
                $oct_payment_id=TransactionPayment::where('transaction_id',$oct_transaction['id'])->get();
                foreach ($oct_payment_id as $oct_payment) {
                    if($oct_payment['payment_categories_id']==3)
                    {
                        $this->oct+=$oct_payment['price']*$oct_payment['qty'];
                        $this->total_M163+=$oct_payment['price']*$oct_payment['qty'];
                    }
                    if($oct_payment['payment_categories_id']==2)
                    {
                        $this->oct+=$oct_payment['price']*$oct_payment['qty'];
                        $this->total_M164+=$oct_payment['price']*$oct_payment['qty'];
                    }
                    if($oct_payment['payment_categories_id']==1)
                    {
                        $this->oct+=$oct_payment['price']*$oct_payment['qty'];
                        $this->total_T164+=$oct_payment['price']*$oct_payment['qty'];
                    }
                }
            }
        }
        //nov
        $nov_transaction_id=Transaction::whereMonth('date', '=', $nov)->whereYear('date', '=', $chart_year)->get();
        foreach ($nov_transaction_id as $nov_transaction) {
            if($nov_transaction['status_id']!=1)
            {
                $nov_payment_id=TransactionPayment::where('transaction_id',$nov_transaction['id'])->get();
                foreach ($nov_payment_id as $nov_payment) {
                    if($nov_payment['payment_categories_id']==3)
                    {
                        $this->nov+=$nov_payment['price']*$nov_payment['qty'];
                        $this->total_M163+=$nov_payment['price']*$nov_payment['qty'];
                    }
                    if($nov_payment['payment_categories_id']==2)
                    {
                        $this->nov+=$nov_payment['price']*$nov_payment['qty'];
                        $this->total_M164+=$nov_payment['price']*$nov_payment['qty'];
                    }
                    if($nov_payment['payment_categories_id']==1)
                    {
                        $this->nov+=$nov_payment['price']*$nov_payment['qty'];
                        $this->total_T164+=$nov_payment['price']*$nov_payment['qty'];
                    }
                }
            }
        }
        //dec
        $dec_transaction_id=Transaction::whereMonth('date', '=', $dec)->whereYear('date', '=', $chart_year)->get();
        foreach ($dec_transaction_id as $dec_transaction) {
            if($dec_transaction['status_id']!=1)
            {
                $dec_payment_id=TransactionPayment::where('transaction_id',$dec_transaction['id'])->get();
                foreach ($dec_payment_id as $dec_payment) {
                    if($dec_payment['payment_categories_id']==3)
                    {
                        $this->dec+=$dec_payment['price']*$dec_payment['qty'];
                        $this->total_M163+=$dec_payment['price']*$dec_payment['qty'];
                    }
                    if($dec_payment['payment_categories_id']==2)
                    {
                        $this->dec+=$dec_payment['price']*$dec_payment['qty'];
                        $this->total_M164+=$dec_payment['price']*$dec_payment['qty'];
                    }
                    if($dec_payment['payment_categories_id']==1)
                    {
                        $this->dec+=$dec_payment['price']*$dec_payment['qty'];
                        $this->total_T164+=$dec_payment['price']*$dec_payment['qty'];
                    }
                }
            }
        }
    }
}

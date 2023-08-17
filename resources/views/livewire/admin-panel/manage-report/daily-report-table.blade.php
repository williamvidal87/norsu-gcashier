<div>
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Manage Report</h1>
        

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body" style="font-size: 10pt">
                <label style="width: 10rem">Date:</label><input type="date" class="form-control" id="date" wire:model="date" wire:change="selectdate" style="width: 10rem">
                <br>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Transaction</th>
                                <th>Cashier</th>
                                <th>Payor</th>
                                <th>Mode Of Payment</th>
                                <th>M-163</th>
                                <th>M-164</th>
                                <th>T-164</th>
                                <th></th>
                                <th>Total</th>
                                <th>Receipt</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($TransactionData as $data)
                                <tr>
                                    <td>{{ 'TR' }}{{ 24160+$data->id }}</td>
                                    <td>{{ $data->getCashier->name }}</td>
                                    <td>{{ $data->payor_name }}</td>
                                    <td>{{ $data->getModeOfPayment->mode_of_payment_name }}</td>
                                    <td>
                                        <?php
                                            $TOTAL_ALL=0;
                                            $M163_TOTAL=0;
                                            foreach ($TransactionPaymentData as $transactionpaymentdata) {
                                                if ($data->id==$transactionpaymentdata->transaction_id&&$transactionpaymentdata->payment_categories_id==3) {
                                                    $M163_TOTAL+=$transactionpaymentdata->qty*$transactionpaymentdata->price;
                                                }
                                            }
                                            if ($M163_TOTAL!=0||$M163_TOTAL!=null) {
                                                if ($data->status_id==1) {
                                                    echo "CANCELLED";
                                                }else {
                                                    echo $M163_TOTAL;
                                                    $TOTAL_ALL+=$M163_TOTAL;
                                                }
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            $M164_TOTAL=0;
                                            foreach ($TransactionPaymentData as $transactionpaymentdata) {
                                                if ($data->id==$transactionpaymentdata->transaction_id&&$transactionpaymentdata->payment_categories_id==2) {
                                                    $M164_TOTAL+=$transactionpaymentdata->qty*$transactionpaymentdata->price;
                                                }
                                            }
                                            if ($M164_TOTAL!=0||$M164_TOTAL!=null) {
                                                if ($data->status_id==1) {
                                                    echo "CANCELLED";
                                                }else {
                                                    echo $M164_TOTAL;
                                                    $TOTAL_ALL+=$M164_TOTAL;
                                                }
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            $T164_TOTAL=0;
                                            foreach ($TransactionPaymentData as $transactionpaymentdata) {
                                                if ($data->id==$transactionpaymentdata->transaction_id&&$transactionpaymentdata->payment_categories_id==1) {
                                                    $T164_TOTAL+=$transactionpaymentdata->qty*$transactionpaymentdata->price;
                                                }
                                            }
                                            if ($T164_TOTAL!=0||$T164_TOTAL!=null) {
                                                if ($data->status_id==1) {
                                                    echo "CANCELLED";
                                                }else {
                                                    echo $T164_TOTAL;
                                                    $TOTAL_ALL+=$T164_TOTAL;
                                                }
                                            }
                                        ?>
                                    </td>
                                    <td></td>
                                    <td>
                                        <?php
                                            echo $TOTAL_ALL;
                                        ?>
                                    </td>
                                    <td>{{ $data->receipt_no }}</td>
                                    <td>
                                        <?php
                                        $date=date_create($data->date);
                                        echo date_format($date,"m/d/Y");
                                        ?>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
    </div>
    
    
</div>
@section('custom_script')
    @include('layouts.scripts.day-sales-table-scripts'); 
@endsection
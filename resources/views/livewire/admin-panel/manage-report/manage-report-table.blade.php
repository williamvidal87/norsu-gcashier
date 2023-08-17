<div>
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Manage Report</h1>
        

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body" style="font-size: 10pt">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Transaction ID</th>
                                <th>Reciept No</th>
                                <th>Cashier</th>
                                <th>Student Name</th>
                                <th>Mode Of Payment</th>
                                <th>Payment Category</th>
                                <th>Total Sales</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ManageReportData as $data)
                                    <tr>
                                        <td>{{ 'TR' }}{{ 24160+$data['transaction_id'] }}</td>
                                        <td>{{ $data['receipt_no'] }}</td>
                                        <td>
                                            @foreach($UserData as $userdata)
                                                @if($data['cashier_id']==$userdata->id)
                                                    {{ $userdata->name }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($StudentData as $studentdata)
                                                @if($data['student_id']==$studentdata->id)
                                                    {{ $studentdata->last_name.' '.$studentdata->first_name }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($ModeOfPaymentData as $modeofpaymentdata)
                                                @if($data['mode_of_payment_id']==$modeofpaymentdata->id)
                                                    {{ $modeofpaymentdata->mode_of_payment_name }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($PaymentCategoriesData as $paymentcategoriesdata)
                                                @if($data['payment_categories_id']==$paymentcategoriesdata->id)
                                                    {{ $paymentcategoriesdata->payment_categories_name }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @if($data['status_id']==1)
                                                {{ 'CANCELLED' }}
                                            @endif
                                            @if($data['status_id']!=1)
                                                {{ $data['total_sales'] }}
                                            @endif
                                        </td>
                                        <td>{{ $data['created_at'] }}</td>
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
    @include('layouts.scripts.manage-report-table-scripts'); 
@endsection
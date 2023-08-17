<div>
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Transaction History</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body" style="font-size: 10.5pt">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Transaction ID</th>
                                <th>Receipt No.</th>
                                <th>Payor</th>
                                <th>Mode of Payment</th>
                                {{-- <th>Payment Details</th> --}}
                                <th>Date Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($TransactionData as $data)
                                <tr style="background-color:<?php
                                    if ($data->status_id==1) {
                                        echo "#ffe9e7";
                                    }
                                ?>">
                                    <td>{{ 'TR' }}{{ 24160+$data->id }}</td>
                                    <td>{{ $data->receipt_no }}</td>
                                    <td>{{ $data->payor_name }}</td>
                                    <td>{{ $data->getModeOfPayment->mode_of_payment_name }}</td>
                                    {{-- <td>
                                        @foreach($TransactionPaymentData as $transactionpaymentdata)
                                            @if($data->id==$transactionpaymentdata->transaction_id)
                                                {{ $transactionpaymentdata->getPaymentDetail->payment_detail_name ?? '' }},
                                            @endif
                                        @endforeach
                                    </td> --}}
                                    <td>{{ $data->created_at->format('m/d/Y h:i A') }}</td>
                                    <td>
                                            <button  class="py-0 btn btn-sm btn-secondary" wire:click="viewTransaction({{$data->id}})"><i class="fas fa-eye"></i> View</button>
                                        {{-- @if($data->status_id!=1)
                                            |
                                            <button  class="py-0 btn btn-sm btn-info" wire:click="editTransaction({{$data->id}})"><i class="fas fa-edit"></i>Edit</button>
                                        @endif --}}
                                        {{-- <button  class="py-0 btn btn-sm btn-danger" wire:click="deleteTransaction({{$data->id}})"><i class="fas fa-trash-alt"></i>Delete</button> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
    </div>
    
    <!-- CREATE EDIT MODAL -->
    <div wire.ignore.self class="modal fade" id="transactionModal" role="dialog" aria-labelledby="transactionModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <livewire:cashier-panel.transaction.transaction-form />
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    
    <!-- VIEW MODAL -->
    <div wire.ignore.self class="modal fade" id="transactionViewModal" role="dialog" aria-labelledby="transactionViewModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <livewire:cashier-panel.transaction.transaction-view />
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    
    <!-- REMARKS MODAL -->
    {{-- <div wire.ignore.self class="modal fade" id="remarkModal" role="dialog" aria-labelledby="remarkModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%) !important;box-shadow: 0 0 500px 500px rgb(22, 22, 22, 0.185)">
            <div class="modal-content">
                <livewire:other.remark />
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div> --}}
    
    
</div>
@section('custom_script')
    @include('layouts.scripts.transaction-history-table-scripts'); 
@endsection
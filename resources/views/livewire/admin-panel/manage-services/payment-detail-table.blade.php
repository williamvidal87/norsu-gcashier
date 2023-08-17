<div>
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Payment Details</h1>
        

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <button style="width: fit-content;margin-left: 1.2rem;margin-top: 1.2rem"  class="btn btn-primary" wire:click="createPaymentDetail"><i class="fas fa-plus-circle"></i> Add Payment Detail</button> 
            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Payment Category</th>
                                <th>Payment Details</th>
                                <th>Purpose</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($PaymentDetailData as $data)
                                <tr>
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->getPaymentCategories->payment_categories_name ?? 'none' }}</td>
                                    <td>{{ $data->payment_detail_name }}</td>
                                    <td>{{ $data->purpose }}</td>
                                    <td>&#8369;{{ $data->price ?? '0' }}</td>
                                    <td>
                                        <button  class="py-0 btn btn-sm btn-info" wire:click="editPaymentDetail({{$data->id}})"><i class="fas fa-edit"></i>Edit</button> | 
                                        <button  class="py-0 btn btn-sm btn-danger" wire:click="deletePaymentDetail({{$data->id}})"><i class="fas fa-trash-alt"></i>Delete</button>
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
    <div wire.ignore.self class="modal fade" id="paymentdetailModal" role="dialog" aria-labelledby="paymentdetailModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <livewire:admin-panel.manage-services.payment-detail-form />
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    
    
</div>
@section('custom_script')
    @include('layouts.scripts.payment-detail-table-scripts'); 
@endsection
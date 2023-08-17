<div>
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Mode Of Payment</h1>
        

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <button style="width: fit-content;margin-left: 1.2rem;margin-top: 1.2rem"  class="btn btn-primary" wire:click="createModeOfPayment"><i class="fas fa-plus-circle"></i> Add Mode Of Payment</button> 
            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Mode Of Payment</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ModeOfPaymentData as $data)
                                <tr>
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->mode_of_payment_name }}</td>
                                    <td>
                                        <button  class="py-0 btn btn-sm btn-info" wire:click="editModeOfPayment({{$data->id}})"><i class="fas fa-edit"></i>Edit</button> | 
                                        <button  class="py-0 btn btn-sm btn-danger" wire:click="deleteModeOfPayment({{$data->id}})"><i class="fas fa-trash-alt"></i>Delete</button>
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
    <div wire.ignore.self class="modal fade" id="modeofpaymentModal" role="dialog" aria-labelledby="modeofpaymentModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <livewire:admin-panel.manage-services.mode-of-payment-form />
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    
    
</div>
@section('custom_script')
    @include('layouts.scripts.mode-of-payment-table-scripts'); 
@endsection
<div>
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Payor</h1>
        

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <button style="width: fit-content;margin-left: 1.2rem;margin-top: 1.2rem"  class="btn btn-primary" wire:click="createStudent"><i class="fas fa-plus-circle"></i> Add Payor</button> 
            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>School ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Middle Name</th>
                                <th>Birth Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($StudentData as $data)
                                <tr>
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->id_number }}</td>
                                    <td>{{ $data->first_name }}</td>
                                    <td>{{ $data->last_name }}</td>
                                    <td>{{ $data->middle_name }}</td>
                                    <td>{{ $data->birth_date }}</td>
                                    <td>
                                        <button  class="py-0 btn btn-sm btn-info" wire:click="editStudent({{$data->id}})"><i class="fas fa-edit"></i>Edit</button> | 
                                        <button  class="py-0 btn btn-sm btn-danger" wire:click="deleteStudent({{$data->id}})"><i class="fas fa-trash-alt"></i>Delete</button>
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
    <div wire.ignore.self class="modal fade" id="studentModal" role="dialog" aria-labelledby="studentModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <livewire:admin-panel.manage-client.student-form />
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    
    
</div>
@section('custom_script')
    @include('layouts.scripts.student-table-scripts'); 
@endsection
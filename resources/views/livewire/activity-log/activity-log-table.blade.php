<div>
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Activity Logs</h1>
        

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Activity</th>
                                <th>Date Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ActivityLogData as $data)
                                <tr>
                                    <td>{{ $data->activity }}</td>
                                    <td>{{ $data->created_at->format('d/m/y h:i A') }}</td>
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
    @include('layouts.scripts.activity-log-table-scripts'); 
@endsection
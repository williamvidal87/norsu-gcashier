
@push('activity-log-table-scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        
        
        $(function () {
            $("#dataTable").DataTable({
                order: [[1, 'desc']],
                dom: 'Bfrtip',
                lengthMenu: [
                    [ 10, 25, 50, -1 ],
                    [ '10 rows', '25 rows', '50 rows', 'Show all' ]
                ],
                buttons: [
                    'pageLength'
                ]
            });
        });
        
        window.livewire.on('EmitTable', () => {
            if ($.fn.DataTable.isDataTable("#dataTable")) {
                $('#dataTable').DataTable().destroy();
            }
            $("#dataTable").DataTable({
                order: [[1, 'desc']],
                dom: 'Bfrtip',
                lengthMenu: [
                    [ 10, 25, 50, -1 ],
                    [ '10 rows', '25 rows', '50 rows', 'Show all' ]
                ],
                buttons: [
                    'pageLength'
                ]
            });
        });
        
        
    })

</script>
@endpush
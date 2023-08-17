
@push('transaction-table-scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        
        window.initStudent_idDrop = () => {
            $('#student_id').select2({
                dropdownParent: $("#transactionModal"),
                placeholder: 'Select a Payor',
                allowClear: false,
                closeOnSelect: true,
            
            });
        }
        
        initStudent_idDrop();
        $('#student_id').on('change', function(e) {
            livewire.emit('selectedStudent', e.target.value)
        });
        
        window.livewire.on('select2', () => {
            initStudent_idDrop();
        });
        
        
        
        
        $(function () {
            $("#dataTable").DataTable({
                order: [[4, 'desc']],
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
                order: [[4, 'desc']],
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
        
        window.livewire.on('openTransactionModal', () => {
            $('#transactionModal').modal('show')
        });
        
        window.livewire.on('openViewTransactionModal', () => {
            $('#transactionViewModal').modal('show')
        });
        
        window.livewire.on('closeTransactionModal', () => {
            $('#transactionModal').modal('hide')
        });
        
        window.livewire.on('closeViewTransactionModal', () => {
            $('#transactionViewModal').modal('hide')
        });
        
        window.livewire.on('openremarkModal', () => {
            $('#remarkModal').modal('show')
        });
        
        window.livewire.on('closeremarkModal', () => {
            $('#remarkModal').modal('hide')
        });
        
        window.livewire.on('openSwalDelete', (TransactionID) => {
            swal("Are you sure you want to delete this Data?", {
                dangerMode: true,
                buttons: true,
            }).then(okay => {
                if (okay) {
                    window.Livewire.emit('DeleteData', TransactionID)
                }else{
                    window.Livewire.emit('refresh_transaction_table')
                }
                });
        });
        
        
        // for store alert
        window.livewire.on('alert_store', () => {
            Toastify({
            text: "Successfully stored.",
            duration: 3000,
            newWindow: true,
            close: true,
            gravity: "top",
            position: "right",
            stopOnFocus: true,
            style: {
            background: "linear-gradient(to right, #1cc88a, #1cc88a)",
            },
            onClick: function(){}
        }).showToast();
        });
        // for update alert
        window.livewire.on('alert_update', () => {
            Toastify({
            text: "Successfully updated.",
            duration: 3000,
            newWindow: true,
            close: true,
            gravity: "top",
            position: "right",
            stopOnFocus: true,
            style: {
            background: "linear-gradient(to right, #4e73df, #4e73df)",
            },
            onClick: function(){}
        }).showToast();
        });
        // for delete alert
        window.livewire.on('alert_delete', () => {
            Toastify({
            text: "Successfully deleted.",
            duration: 3000,
            newWindow: true,
            close: true,
            gravity: "top",
            position: "right",
            stopOnFocus: true,
            style: {
            background: "linear-gradient(to right, #e74a3b, #e74a3b)",
            },
            onClick: function(){}
        }).showToast();
        });
        // for cancel alert
        window.livewire.on('alert_cancel', () => {
            Toastify({
            text: "Successfully cancelled.",
            duration: 3000,
            newWindow: true,
            close: true,
            gravity: "top",
            position: "right",
            stopOnFocus: true,
            style: {
            background: "linear-gradient(to right, #e74a3b, #e74a3b)",
            },
            onClick: function(){}
        }).showToast();
        });
        // for warning alert
        window.livewire.on('alert_warning', () => {
            Toastify({
            text: "Your are not allowed to edit this record right now.",
            duration: 6000,
            newWindow: true,
            close: true,
            gravity: "top",
            position: "right",
            stopOnFocus: true,
            style: {
            background: "linear-gradient(to right, #f6c23e, #f6c23e)",
            },
            onClick: function(){}
        }).showToast();
        });
        
        
    })

</script>
@endpush
<div>
    <div class="modal-header">
        <h1 class="modal-title" id="exampleModalLabel">Mode Of Payment</h1>
        <button class="close" data-dismiss="modal" aria-label="Close" wire:click="closeModeOfPaymentForm"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="mode_of_payment_name">Mode Of Payment</small></label>
            <input type="text" class="form-control" id="mode_of_payment_name" wire:model="mode_of_payment_name">
            @error('mode_of_payment_name') <span style="color: red">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" wire:click="closeModeOfPaymentForm">Close</button>
        @if(!empty($this->ModeOfPaymentID))
            <button class="btn btn-primary" wire:click="store">Save changes</button>
        @else
            <button class="btn btn-primary" wire:click="store">Submit</button>
        @endif
    </div>
</div>

<div>
    <div class="modal-header">
        <h1 class="modal-title" id="exampleModalLabel">Payment Categories</h1>
        <button class="close" data-dismiss="modal" aria-label="Close" wire:click="closePaymentCategoryForm"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="payment_categories_name">Payment Category</label>
            <input type="text" class="form-control" id="payment_categories_name" wire:model="payment_categories_name">
            @error('payment_categories_name') <span style="color: red">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" wire:click="closePaymentCategoryForm">Close</button>
        @if(!empty($this->PaymentCategoryID))
            <button class="btn btn-primary" wire:click="store">Save changes</button>
        @else
            <button class="btn btn-primary" wire:click="store">Submit</button>
        @endif
    </div>
</div>

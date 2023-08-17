<div>
    <div class="modal-header">
        <h1 class="modal-title" id="exampleModalLabel">Payment Details</h1>
        <button class="close" data-dismiss="modal" aria-label="Close" wire:click="closePaymentDetailForm"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="payment_categories_id">Payment Category</label>
            <select class="form-control" id="payment_categories_id" wire:model="payment_categories_id">
                <option value="0">Select Payment Category</option>
                @foreach($PaymentCategories_Data as $paymentcategories_Data)
                    <option value="{{ $paymentcategories_Data->id }}">{{ $paymentcategories_Data->payment_categories_name }}</option>
                @endforeach
            </select>
            @error('payment_categories_id') <span style="color: red">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="payment_detail_name">Payment Detail</label>
            <input type="text" class="form-control" id="payment_detail_name" wire:model="payment_detail_name">
            @error('payment_detail_name') <span style="color: red">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="purpose">Purpose <small>(Optional)</small></label>
            <textarea class="form-control" rows="3" id="purpose" wire:model="purpose"></textarea>
            @error('purpose') <span style="color: red">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" wire:model="price">
            @error('price') <span style="color: red">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" wire:click="closePaymentDetailForm">Close</button>
        @if(!empty($this->PaymentDetailID))
            <button class="btn btn-primary" wire:click="store">Save changes</button>
        @else
            <button class="btn btn-primary" wire:click="store">Submit</button>
        @endif
    </div>
</div>

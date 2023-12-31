<div>
    <div class="modal-header">
        <h1 class="modal-title" id="exampleModalLabel">Transaction</h1>
        <button class="close" data-dismiss="modal" aria-label="Close" wire:click="closeTransactionViewForm"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-10">
            </div>
            <div class="col-sm-2">
                <label for="student_id">{{ $this->Date }}</label>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="receipt_no">Receipt No.</label>
                    <input type="text" class="form-control" id="receipt_no" wire:model="receipt_no" disabled>
                    @error('receipt_no') <span style="color: red">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="payor_name">Payor</label>
                    <input type="text" class="form-control" id="payor_name" wire:model="payor_name" disabled>
                    @error('payor_name') <span style="color: red">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="mode_of_payment_id">Mode Of Payment</label>
                    <select class="form-control" id="mode_of_payment_id" wire:model="mode_of_payment_id" disabled>
                        <option value="">Select Mode Of Payment</option>
                        @foreach($ModeOfPaymentData as $modeofpayment_data)
                            <option value="{{ $modeofpayment_data->id }}">{{ $modeofpayment_data->mode_of_payment_name }}</option>
                        @endforeach
                    </select>
                    @error('mode_of_payment_id') <span style="color: red">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        {{-- start test --}}
        @if($this->mode_of_payment_id==2)
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="check_bank">Drawee Bank</label>
                    <input type="text" class="form-control" id="check_bank" wire:model="check_bank" disabled>
                    @error('check_bank') <span style="color: red">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="check_number">Check Number</label>
                    <input type="text" class="form-control" id="check_number" wire:model="check_number" disabled>
                    @error('check_number') <span style="color: red">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="check_date">Check Date</label>
                    <input type="date" class="form-control" id="check_date" wire:model="check_date" disabled>
                    @error('check_date') <span style="color: red">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
        @else
        <div></div>
        @endif
        {{-- end test --}}

        <div class="form-group">
            <table class="table" id="products_table">
                <thead>
                    <tr>
                        <th width="18%">Payment Category</th>
                        <th width="30%">Payment Details</th>
                        <th width="15%">Price</th>
                        <th width="12%">Qty</th>
                        <th width="12%">Total</th>
                        {{-- <th width="13%">Action</th> --}}
                    </tr>
                </thead>
            </table>
                <table class="table" id="products_table">
                    <tbody>
                        @foreach ($orderProducts as $index => $orderProduct)
                            <tr>
                                <td width="18%">
                                    <select name="orderProducts[{{$index}}][payment_categories_id]"
                                        wire:model="orderProducts.{{$index}}.payment_categories_id"
                                        class="form-control" required disabled>
                                        <option value="">Select Category</option>
                                        @foreach ($PaymentCategoriesData as $product)
                                        <option value="{{ $product->id }}">{{ $product->payment_categories_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('orderProducts'.'.'.$index.'.'.'payment_categories_id') <span style="color: red">Required</span> @enderror
                                </td>
                                <td width="30%">
                                    <select name="orderProducts[{{$index}}][payment_detail_id]"
                                    wire:model="orderProducts.{{$index}}.payment_detail_id"
                                    class="form-control" required disabled>
                                        <option value="">Select Details</option>
                                            @foreach ($PaymentDetailData as $product2)
                                                @if ($this->orderProducts[$index]['payment_categories_id']==$product2->payment_categories_id)
                                                        <option <?php
                                                            for ($i=0; $i < count($this->orderProducts); $i++) {
                                                                if(!empty($this->orderProducts[$i]['payment_detail_id'])){
                                                                    if ($product2->id == $this->orderProducts[$i]['payment_detail_id']) {
                                                                        if ($this->orderProducts[$index]['payment_detail_id'] == $this->orderProducts[$i]['payment_detail_id']) {
                                                                            // echo "none";
                                                                        } else {
                                                                            echo "disabled";
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        ?> value="{{ $product2->id }}">{{ $product2->payment_detail_name }} {{ $product2->purpose }}<?php
                                                            for ($i=0; $i < count($this->orderProducts); $i++) {
                                                                if(!empty($this->orderProducts[$i]['payment_detail_id'])){
                                                                    if ($product2->id == $this->orderProducts[$i]['payment_detail_id']) {
                                                                        if ($this->orderProducts[$index]['payment_detail_id'] == $this->orderProducts[$i]['payment_detail_id']) {
                                                                            // echo "none";
                                                                        } else {
                                                                            echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You Already taken.";
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        ?></option>
                                                @endif
                                                {{-- @if($this->orderProducts[$index]['payment_categories_id']!=$product2->payment_categories_id)
                                                    {{ $this->orderProducts[$index]['payment_detail_id']=null }}
                                                @endif --}}
                                            @endforeach
                                    </select>
                                    @error('orderProducts'.'.'.$index.'.'.'payment_detail_id') <span style="color: red">Required</span> @enderror
                                </td>
                                <td width="15%">
                                    <div class="row">
                                        <div class="col-sm-1">
                                            &#8369;
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" disabled value="<?php
                                                if ($this->orderProducts[$index]['payment_detail_id']&&$this->orderProducts[$index]['payment_categories_id']) {
                                                    foreach ($PaymentDetailData as $paymentdetaildata) {
                                                        if ($this->orderProducts[$index]['payment_detail_id']==$paymentdetaildata->id) {
                                                            if ($this->orderProducts[$index]['price']) {
                                                            echo $this->orderProducts[$index]['price'];
                                                            } else {
                                                            echo $paymentdetaildata->price;
                                                            }
                                                        }
                                                    }
                                                }
                                            ?>">
                                        </div>
                                    </div>
                                </td>
                                <td width="12%">
                                    <input disabled type="number" step="any" name="orderProducts[{{$index}}][qty]" wire:model="orderProducts.{{$index}}.qty" type="text" class="form-control">
                                    @error('orderProducts'.'.'.$index.'.'.'qty') <span style="color: red">Required</span> @enderror
                                </td>
                                <td width="12%">
                                    <?php
                                        if ($this->orderProducts[$index]['payment_detail_id']&&$this->orderProducts[$index]['payment_categories_id']) {
                                            foreach ($PaymentDetailData as $paymentdetaildata) {
                                                if ($this->orderProducts[$index]['payment_detail_id']==$paymentdetaildata->id) {
                                                    if ($this->orderProducts[$index]['qty']!=null) {
                                                        if ($this->orderProducts[$index]['price']) {
                                                                echo "&#8369;";
                                                                echo number_format($this->orderProducts[$index]['price']*$this->orderProducts[$index]['qty'], 2, '.', ',');
                                                                $total_all+=$this->orderProducts[$index]['price']*$this->orderProducts[$index]['qty'];
                                                            } else {
                                                                echo "&#8369;";
                                                                echo number_format($paymentdetaildata->price*$this->orderProducts[$index]['qty'], 2, '.', ',');
                                                                $total_all+=$paymentdetaildata->price*$this->orderProducts[$index]['qty'];
                                                            }
                                                    }
                                                }
                                            }
                                        }
                                    ?>
                                </td>
                                {{-- <td width="13%">
                                    <button wire:click.prevent="removeProduct({{$index}})" class="py-0 btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i>Delete</button>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            <br>
            <table class="table" id="products_table">
                <tfoot>
                    <tr>
                        <th width="63%"></th>
                        <th width="7%"></th>
                        <th width="5%">Total:</th>
                        <th width="12%">&#8369;{{ number_format($total_all, 2, '.', ',') ?? '0' }}</th>
                        {{-- <th width="13%"></th> --}}
                    </tr>
                </tfoot>
            </table>
            <div class="row">
                <div class="col-md-8">
                </div>
                <div class="col-md-4">
                    <label for="note">Note:</label>
                    <div class="form-group">
                        <textarea id="note" class="form-control" wire:model="note" style="width: 3.50in;height: 1in" disabled></textarea>
                        @error('note') <span style="color: red">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" wire:click="closeTransactionViewForm">Close</button>
        <div>
            @if($this->status_id!=1)
                <button class="btn btn-danger" wire:click="CancelTransaction"><i class="fas fa-exclamation-triangle"></i> Cancel Trasaction</button>
            @endif
                <button class="btn btn-primary" wire:click="PrintTransactionReceipt" style="width: 131pt"><i class="fa fa-download"></i> Print Receipt</button>
        </div>
    </div>
</div>

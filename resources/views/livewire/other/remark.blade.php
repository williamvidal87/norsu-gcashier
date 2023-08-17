<div>
    <div class="modal-body">
        <div class="form-group">
            <label for="remark">Remarks <small>(optional)</small></label>
            <input style="width: 20rem" type="text" class="form-control" id="remark" wire:model="remark">
        </div>
    </div>
    <div class="modal-footer">
        <div>
            <button class="btn btn-secondary" wire:click="NoRemark">No</button>
            <button class="btn btn-danger" wire:click="YesRemark">Yes</button>
        </div>
    </div>
</div>

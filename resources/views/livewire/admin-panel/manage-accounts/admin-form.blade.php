<div>
        <div class="modal-header">
            <h1 class="modal-title" id="exampleModalLabel">Admin</h1>
            <button class="close" data-dismiss="modal" aria-label="Close" wire:click="closeAdminForm"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" wire:model="name">
                @error('name') <span style="color: red">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" wire:model="email">
                @error('email') <span style="color: red">{{ $message }}</span> @enderror
            </div>
            @if($this->UserID)
                <div class="form-group">
                    <label for="newpassword">New Password</label>
                    <input type="password" class="form-control" id="newpassword" wire:model="newpassword" placeholder="New Password">
                    @error('newpassword') <span style="color: red">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="confirmpassword">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmpassword" wire:model="confirmpassword" placeholder="Confirm Password">
                    @error('confirmpassword') <span style="color: red">{{ $message }}</span> @enderror
                </div>
            @else
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" wire:model="password" placeholder="Password">
                    @error('password') <span style="color: red">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="confirmpassword">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmpassword" wire:model="confirmpassword" placeholder=" Confirm Password">
                    @error('confirmpassword') <span style="color: red">{{ $message }}</span> @enderror
                </div>
            @endif
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" wire:click="closeAdminForm">Close</button>
            @if(!empty($this->UserID))
                <button class="btn btn-primary" wire:click="store">Save changes</button>
            @else
                <button class="btn btn-primary" wire:click="store">Submit</button>
            @endif
        </div>
</div>

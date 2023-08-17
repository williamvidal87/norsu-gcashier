<div>
    <div class="modal-header">
        <h1 class="modal-title" id="exampleModalLabel">Payor</h1>
        <button class="close" data-dismiss="modal" aria-label="Close" wire:click="closeStudentForm"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="id_number">ID Number <small>(optional)</small></label>
                    <input type="text" class="form-control" id="id_number" wire:model="id_number">
                    @error('id_number') <span style="color: red">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-sm-8">
                <div class="form-group">
                    <label for="course_id">Course <small>(optional)</small></label>
                    <select class="form-control" id="course_id" wire:model="course_id" style="width:500px">
                        <option value="0">Select Course</option>
                        @foreach($Course_Data as $course_data)
                            <option value="{{ $course_data->id }}">{{ $course_data->course_name }}</option>
                        @endforeach
                    </select>
                    @error('course_id') <span style="color: red">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" wire:model="first_name">
                    @error('first_name') <span style="color: red">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="last_name">Last Name <small>(optional)</small></label>
                    <input type="text" class="form-control" id="last_name" wire:model="last_name">
                    @error('last_name') <span style="color: red">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="middle_name">Middle Name <small>(optional)</small></label>
                    <input type="text" class="form-control" id="middle_name" wire:model="middle_name">
                    @error('middle_name') <span style="color: red">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="birth_date">Birth Date <small>(optional)</small></label>
                    <input type="date" class="form-control" id="birth_date" wire:model="birth_date">
                    @error('birth_date') <span style="color: red">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" wire:click="closeStudentForm">Close</button>
        @if(!empty($this->StudentID))
            <button class="btn btn-primary" wire:click="store">Save changes</button>
        @else
            <button class="btn btn-primary" wire:click="store">Submit</button>
        @endif
    </div>
</div>

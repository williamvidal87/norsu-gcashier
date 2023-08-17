<?php

namespace App\Http\Livewire\ActivityLog;

use App\Models\UserActivityLogsDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ActivityLogTable extends Component
{
    
    public function render()
    {
        $this->emit('EmitTable');
        return view('livewire.activity-log.activity-log-table',[
            'ActivityLogData' =>  UserActivityLogsDatabase::where('user_id',Auth::user()->id)->get()
        ]);
    }
}

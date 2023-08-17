<?php

namespace App\Http\Livewire\Other;

use Livewire\Component;

class Remark extends Component
{
    public $remark;
    
    public function render()
    {
        return view('livewire.other.remark');
    }
    
    public function YesRemark()
    {
        $this->emit('RemarkName',$this->remark);
    }
    
    public function NoRemark()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emit('closeremarkModal');
    }
}

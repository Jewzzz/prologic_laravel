<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Note;

class NoteDeatails extends Component
{
    public $notes,$cus_id ,$name, $description, $note_id;
    public $isModalOpen = 0;
    
    public function render()
    {
        $this->notes = Note::all();
        return view('livewire.note-deatails');
    }

    public function create()
    {
        $this->resetCreateForm();
        $this->openModalPopover();
    }

    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }

    public function closeModalPopover()
    {
        $this->isModalOpen = false;
    }

    private function resetCreateForm(){
        $this->cus_id = '';
        $this->name = '';
        $this->description = '';
    }
    
    public function store()
    {
        $this->validate([
            'cus_id' => 'required',
            'name' => 'required |max:75',
            'description' => 'required | max:255',
        ]);
    
        Note::updateOrCreate(['id' => $this->note_id], [
            'cus_id' => $this->cus_id,
            'name' => $this->name,
            'description' => $this->description,
        ]);

        session()->flash('message', $this->note_id ? 'Note updated.' : 'Note created.');

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $note = Note::findOrFail($id);
        $this->note_id = $id;
        $this->cus_id = $note->cus_id;
        $this->name = $note->name;
        $this->description = $note->description;
    
        $this->openModalPopover();
    }
    
    public function delete($id)
    {
        Note::find($id)->delete();
        session()->flash('message', 'Note deleted.');
    }
}

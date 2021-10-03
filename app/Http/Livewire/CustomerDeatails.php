<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Customer;

class CustomerDeatails extends Component
{
    public $customers, $name, $email, $mobile, $company_name ,$customer_id;
    public $isModalOpen = 0;

    public function render()
    {
        $this->customers = Customer::all();
        return view('livewire.customer-deatails');
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
        $this->name = '';
        $this->email = '';
        $this->mobile = '';
        $this->company_name= '';
    }
    
    public function store()
    {
        $this->validate([
            'name' => 'required | max:50',
            'email' => 'required | max:50',
            'mobile' => 'required |min:9 | max:12',
            'company_name' =>'required | max:100',
        ]);
    
        Customer::updateOrCreate(['id' => $this->customer_id], [
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'company_name' => $this->company_name,
        ]);

        session()->flash('message', $this->customer_id ? 'Customert updated.' : 'Customert created.');

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        $this->customer_id = $id;
        $this->name = $customer->name;
        $this->email = $customer->email;
        $this->mobile = $customer->mobile;
        $this->company_name = $customer->company_name;
    
        $this->openModalPopover();
    }
    
    public function delete($id)
    {
        Customer::find($id)->delete();
        session()->flash('message', 'Customer deleted.');
    }
}

<x-slot name="header">
    <h2 class="text-center">Note Deatails</h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
            <div class="bg-red-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                role="alert">
                <div class="flex">
                    <div>
                        <p class="text-sm">{{ session('message') }}</p>
                    </div>
                </div>
            </div><br>
            @endif
            <button wire:click="create()"
                class="my-4 inline-flex justify-center rounded-md border border-transparent px-4 py-2 bg-red-600 text-base font-bold text-white shadow-sm hover:bg-red-700">
                Create Note
            </button><br><br>
            @if($isModalOpen)
            @include('livewire.create-note')
            @endif
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No.</th>
                        <th class="px-4 py-2">Customer ID</th>
                        <th class="px-4 py-2">Note Name</th>
                        <th class="px-4 py-2">Description</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($notes as $note)
                    <tr>
                        <td class="border px-4 py-2">{{ $note->id }}</td>
                        <td class="border px-4 py-2">{{ $note->cus_id }}</td>
                        <td class="border px-4 py-2">{{ $note->name}}</td>
                        <td class="border px-4 py-2">{{ $note->description}}</td>
                        <td class="border px-4 py-2">
                            <button wire:click="edit({{ $note->id }})"
                                class="flex px-4 py-2 bg-gray-500 text-gray-900 cursor-pointer">Edit</button>
                            <button wire:click="delete({{ $note->id }})"
                                class="flex px-4 py-2 bg-red-100 text-gray-900 cursor-pointer">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

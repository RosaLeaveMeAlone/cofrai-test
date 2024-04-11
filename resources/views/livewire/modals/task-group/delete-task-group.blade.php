<x-confirmation-modal>
    <x-slot name="title">
        Delete Task Group
    </x-slot>

    <x-slot name="content">
        Are you sure you want to delete this task group? {{ $id }}
    </x-slot>

    <x-slot name="buttons">
        <button type="button" wire:click="deleteTaskGroup({{$id}})" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
        <button type="button" wire:click="closeModal" class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900">Blue</button>
    </x-slot>    
    
</x-modal>
<x-modal>
    <x-slot name="title">
        {{ $this->id ? 'Update Task Group' : 'New Task Group' }}
    </x-slot>

    <x-slot name="content">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input wire:model.defer="name" type="text" name="name" id="name" class="mt-1 p-2 block w-full border-gray-300 rounded-md">
            @error('name')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        
            <label for="description" class="block mt-4 text-sm font-medium text-gray-700">Description</label>
            <textarea wire:model.defer="description" name="description" id="description" rows="4" class="mt-1 p-2 block w-full border-gray-300 rounded-md"></textarea>
            @error('description')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
    </x-slot>

    <x-slot name="buttons">
        <button 
            type="button" 
            wire:click="closeModal" 
            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 
            font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700"
        >
            Close
        </button>
        <button 
            type="button" 
            wire:click="saveTaskGroup"
            class="focus:outline-none text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 
            me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900"
        >
            {{ $this->id ? 'Update' : 'Save' }}
        </button>
    </x-slot>  
    
</x-modal>
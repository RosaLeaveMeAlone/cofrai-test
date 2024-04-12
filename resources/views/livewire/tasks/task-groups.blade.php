<div>

        <div class="flex justify-between items-center mt-8 text-2xl">
            <div class="text-left">Task Groups</div>
            <button 
                class="focus:outline-none text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900"
                wire:click="$dispatch('openModal', { component: 'modals.task-group.task-group-form'})"
            >
                New Task Group
            </button>
        </div>

        
        
        <div class="mt-6">
            <div class="flex justify-between">
                <div class="p-2">
                    <input 
                        wire:model.live.debounce.300ms="search"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                        type="text" 
                        placeholder="Search..." 
                    />
                </div>
            </div>
            <table class="table-auto w-full mt-2">
                <thead>
                    <tr>
                        <x-table.th wire:click="sortBy('id')">ID</x-th>
                        <x-table.th wire:click="sortBy('name')">Name</x-th>
                        <x-table.th wire:click="sortBy('description')">Description</x-th>
                                    
                        <th class="px-4 py-2">
                            <div class="flex items-center">
                                Actions
                            </div>
                        </th> 
                    </tr>
                </thead>
                <tbody>
                    @forelse($this->task_groups as $taskGroup)
                        <tr>
                            <td class="border px-4 py-2">
                                {{ $taskGroup->id }}
                            </td>
                            <td class="border px-4 py-2">
                                {{ $taskGroup->name }}
                            </td>
                            <td class="border px-4 py-2">
                                {{ $taskGroup->description }}
                            </td>
                            <td class="border px-4 py-2">
                                <button 
                                    class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900"
                                    wire:click="$dispatch('openModal', { component: 'modals.task-group.task-group-form', arguments: { id: {{ $taskGroup->id }} }})"
                                >
                                    Editar
                                </button>
                                <button 
                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                    wire:click="$dispatch('openModal', { component: 'modals.task-group.delete-task-group', arguments: { id: {{ $taskGroup->id }} }})"
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="border px-4 py-2 text-center" colspan="4">
                                No task groups found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            
        </div>

        {{ $this->task_groups->links() }}

        


</div>

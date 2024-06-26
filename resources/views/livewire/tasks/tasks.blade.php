<div>

    <div class="flex justify-between items-center mt-8 text-2xl">
        <div class="text-left">Tasks</div>
        <button 
            class="focus:outline-none text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900"
            wire:click="$dispatch('openModal', { component: 'modals.task.task-form'})"
        >
            New Task
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
        <div class="mt-2 overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr>
                        <x-table.th wire:click="sortBy('id')" class="w-1/6">ID</x-th>
                        <x-table.th wire:click="sortBy('title')" class="w-1/6">Title</x-th>
                        <x-table.th wire:click="sortBy('description')" class="w-1/6">Description</x-th>
                        <th class="w-1/6">
                            <div class="flex flex-row items-center">
                                Frequency
                            </div>
                        </th>
                        <x-table.th wire:click="sortBy('task_group_name')" class="">Group</x-th>
                        <x-table.th wire:click="sortBy('repetitions')" class="">Repetitions</x-th>
                        <x-table.th wire:click="sortBy('start_date')" class="">Start Date</x-th>
                        <x-table.th wire:click="sortBy('end_date')" class="">End Date</x-th>
                                    
                        <th class="px-4 py-2 ">
                            <div class="flex items-center">
                                Actions
                            </div>
                        </th> 
                    </tr>
                </thead>
                <tbody>
                    @forelse($this->tasks as $task)
                        <tr>
                            <td class="border px-4 py-2">
                                {{ $task->id }}
                            </td>
                            <td class="border px-4 py-2">
                                {{ $task->title }}
                            </td>
                            <td class="border px-4 py-2">
                                {{ $task->description }}
                            </td>
                            <td class="border px-4 py-2">
                                {{ $this->translateCron($task->frequency) }}
                            </td>
                            <td class="border px-4 py-2">
                                {{ $task->task_group_name }}
                            </td>
                            <td class="border px-4 py-2">
                                {{ $task->repetitions ?? '-' }}
                            </td>
                            <td class="border px-4 py-2">
                                {{ $task->start_date ?? '-' }}
                            </td>
                            <td class="border px-4 py-2">
                                {{ $task->end_date ?? '-'}}
                            </td>
                            <td class="border px-4 py-2">
                                <button 
                                    class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900"
                                    wire:click="$dispatch('openModal', { component: 'modals.task.task-form', arguments: { id: {{ $task->id }} }})"
                                >
                                    Edit
                                </button>
                                <button 
                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                    wire:click="$dispatch('openModal', { component: 'modals.task.delete-task', arguments: { id: {{ $task->id }} }})"
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="border px-4 py-2 text-center" colspan="4">
                                No tasks found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
    </div>

    {{ $this->tasks->links() }}

    


</div>

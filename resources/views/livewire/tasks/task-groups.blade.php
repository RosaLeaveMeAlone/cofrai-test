<div>
   
        <div class="mt-8 text-2xl">
            Task Groups
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
                        <th class="px-4 py-2">
                            <div class="flex items-center">
                                ID
                            </div>
                        </th>
                        <th class="px-4 py-2">
                            <div class="flex items-center">
                                Name
                            </div>
                        </th>
                        <th class="px-4 py-2">
                            <div class="flex items-center">
                                Description
                            </div>
                        </th>
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
                                {{ $taskGroup->id }}
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

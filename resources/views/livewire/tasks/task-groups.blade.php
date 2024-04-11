<div>
   
        <div class="mt-8 text-2xl">
            Task Groups
        </div>

        <div class="mt-6">
            <table class="table-auto w-full">
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



</div>

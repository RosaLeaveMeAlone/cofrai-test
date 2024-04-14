<div>
    <div class="flex justify-between items-center mt-8 text-2xl">
        <div class="text-left">View Tasks</div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4" wire:ignore>
        <div>
            <div class="text-left">Today</div>
            <ul>
                @forelse($todayTasks as $task)
                    @foreach($task->generatedTasks as $generatedTask)
    
                    <li 
                        class="bg-white rounded-lg shadow-md p-4 mb-2 flex justify-between items-center"
                        x-data="{ completed: {{ $generatedTask->is_done ? 'true' : 'false' }} }"
                    >
                        <div>
                            <span class="font-semibold">{{ $task->title }}</span>
                            <span class="ml-2 text-slate-600">{{ $task->taskgroup->name ?? '' }}</span>
                            <br>
                            <span class="text-sm text-gray-400">{{ $generatedTask->date }}</span>
                            <p class="text-sm text-gray-500">{{ $task->description }}</p>
                        </div>
                        <input 
                            type="checkbox" 
                            class="form-checkbox h-5 w-5 text-blue-500" 
                            x-model="completed"
                            x-on:click="$wire.toggleTaskStatus({{ $generatedTask->id }})"
                        >
                    </li>
    
                    @endforeach
                @empty
                <li class="bg-white rounded-lg shadow-md p-4 mb-2">
                    <p class="text-gray-500">No tasks for today</p>
                </li>
                @endforelse
    
            </ul>
        </div>


        <div>
            <div class="text-left">Tomorrow</div>
            <ul>
                @forelse($tomorrowTasks as $task)
                <li class="bg-white rounded-lg shadow-md p-4 mb-2 flex justify-between items-center"
                    x-data="{ completed: {{ $task['is_done'] ? 'true' : 'false' }} }">
                    <div>
                        <span class="font-semibold">{{ $task['title'] }}</span>
                        <span class="ml-2 text-slate-600">{{ $task['group'] ?? '' }}</span>
                        <br>
                        <span class="text-sm text-gray-400">{{ $task['date'] }}</span>
                        <p class="text-sm text-gray-500">{{ $task['description'] }}</p>
                    </div>
                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-500"
                        x-model="completed"
                        x-on:click="$wire.toggleTaskStatus({{ $task['id'] }})">
                </li>
            @empty
                <li class="bg-white rounded-lg shadow-md p-4 mb-2">
                    <p class="text-gray-500">No tasks for tomorrow</p>
                </li>
            @endforelse
    
            </ul>
        </div>


        <div>
            <div class="text-left">This week</div>
            <ul>
                @forelse($thisWeekTasks as $task)
                    <li class="bg-white rounded-lg shadow-md p-4 mb-2 flex justify-between items-center"
                        x-data="{ completed: {{ $task['is_done'] ? 'true' : 'false' }} }">
                        <div>
                            <span class="font-semibold">{{ $task['title'] }}</span>
                            <span class="ml-2 text-slate-600">{{ $task['group'] ?? '' }}</span>
                            <br>
                            <span class="text-sm text-gray-400">{{ $task['date'] }}</span>
                            <p class="text-sm text-gray-500">{{ $task['description'] }}</p>
                        </div>
                        <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-500"
                            x-model="completed"
                            x-on:click="$wire.toggleTaskStatus({{ $task['id'] }})">
                    </li>
                @empty
                    <li class="bg-white rounded-lg shadow-md p-4 mb-2">
                        <p class="text-gray-500">No tasks for this week</p>
                    </li>
                @endforelse
            </ul>
        </div>


        <div>
            <div class="text-left">Next week</div>
            <ul>
                @forelse($nextWeekTasks as $task)
                    <li class="bg-white rounded-lg shadow-md p-4 mb-2 flex justify-between items-center"
                        x-data="{ completed: {{ $task['is_done'] ? 'true' : 'false' }} }">
                        <div>
                            <span class="font-semibold">{{ $task['title'] }}</span>
                            <span class="ml-2 text-slate-600">{{ $task['group'] ?? '' }}</span>
                            <br>
                            <span class="text-sm text-gray-400">{{ $task['date'] }}</span>
                            <p class="text-sm text-gray-500">{{ $task['description'] }}</p>
                        </div>
                        <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-500"
                            x-model="completed"
                            x-on:click="$wire.toggleTaskStatus({{ $task['id'] }})">
                    </li>
                @empty
                    <li class="bg-white rounded-lg shadow-md p-4 mb-2">
                        <p class="text-gray-500">No tasks for next week</p>
                    </li>
                @endforelse
            </ul>
        </div>
        

        <div>
            <div class="text-left">Near future</div>
            <ul>
                @forelse($nearFutureTasks as $task)
                    <li class="bg-white rounded-lg shadow-md p-4 mb-2 flex justify-between items-center"
                        x-data="{ completed: {{ $task['is_done'] ? 'true' : 'false' }} }">
                        <div>
                            <span class="font-semibold">{{ $task['title'] }}</span>
                            <span class="ml-2 text-slate-600">{{ $task['group'] ?? '' }}</span>
                            <br>
                            <span class="text-sm text-gray-400">{{ $task['date'] }}</span>
                            <p class="text-sm text-gray-500">{{ $task['description'] }}</p>
                        </div>
                        <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-500"
                            x-model="completed"
                            x-on:click="$wire.toggleTaskStatus({{ $task['id'] }})">
                    </li>
                @empty
                    <li class="bg-white rounded-lg shadow-md p-4 mb-2">
                        <p class="text-gray-500">No tasks for near future</p>
                    </li>
                @endforelse
            </ul>
        </div>
        

        <div>
            <div class="text-left">Future</div>
            <ul>
                @forelse($futureTasks as $task)
                    <li class="bg-white rounded-lg shadow-md p-4 mb-2 flex justify-between items-center"
                        x-data="{ completed: {{ $task['is_done'] ? 'true' : 'false' }} }">
                        <div>
                            <span class="font-semibold">{{ $task['title'] }}</span>
                            <span class="ml-2 text-slate-600">{{ $task['group'] ?? '' }}</span>
                            <br>
                            <span class="text-sm text-gray-400">{{ $task['date'] }}</span>
                            <p class="text-sm text-gray-500">{{ $task['description'] }}</p>
                        </div>
                        <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-500"
                            x-model="completed"
                            x-on:click="$wire.toggleTaskStatus({{ $task['id'] }})">
                    </li>
                @empty
                    <li class="bg-white rounded-lg shadow-md p-4 mb-2">
                        <p class="text-gray-500">No tasks for future</p>
                    </li>
                @endforelse
            </ul>
        </div>

    </div>

</div>
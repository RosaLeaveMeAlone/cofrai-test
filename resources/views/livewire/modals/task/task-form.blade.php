<x-modal>
    <x-slot name="title">
        {{ $this->id ? 'Update Task Group' : 'New Task Group' }}
    </x-slot>

    <x-slot name="content">
        <div x-data="{
            title: @entangle('title'),
            description: @entangle('description'),
            taskGroupId: @entangle('taskGroupId'),
            frequencyOption: @entangle('frequencyOption'),
            selectedDays: @entangle('selectedDays'),
            selectedMonthDay: @entangle('selectedMonthDay'),
            repetitionOption: @entangle('repetitionOption'),
            iterations: @entangle('iterations'),
            startDate: @entangle('startDate'),
            endDate: @entangle('endDate'),
        }">
            <div class="form-group">
                <label for="title" class="block text-sm font-medium text-gray-700">Title:</label>
                <input x-model="title" type="text" name="title" id="title" class="mt-1 p-2 block w-full border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 shadow-sm sm:text-sm">
                @error('title')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
                <textarea x-model="description" class="mt-1 p-2 block w-full border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 shadow-sm sm:text-sm" id="description" name="description" rows="3"></textarea>
                @error('description')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>Task Group:</label>
                <div class="mt-2">
                    <select 
                        x-model="taskGroupId"
                        class="mt-1 p-2 block w-full border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 shadow-sm sm:text-sm"
                    >  
                        <option value='null' selected>No Task Group</option>
                        @foreach ($this->taskGroups as $taskGroup)
                            <option value="{{$taskGroup->id}}">
                                {{ $taskGroup->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('taskGroupId')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            
            {{-- START FREQUENCY --}}
            <div class="form-group">
                <label for="frequency" class="block text-sm font-medium text-gray-700">Frequency:</label>
                <select x-model="frequencyOption" class="mt-1 p-2 block w-full border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 shadow-sm sm:text-sm" id="frequency" name="frequency">
                    <option value="daily">Every Day</option>
                    <option value="weekly">Every Week</option>
                    <option value="monthly">Every Month</option>
                </select>
            </div>
            
            <div id="weekly-options" x-show="frequencyOption == 'weekly'">
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700">Days of week:</label>
                    @error('selectedDays')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                    @foreach(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $index => $day)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="{{ $day . '-' . $index }}" x-model="selectedDays" value="{{ $index + 1 }}">
                            <label class="form-check-label" for="{{ $day . '-' . $index }}">{{ ucfirst($day) }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <div id="monthly-options" x-show="frequencyOption == 'monthly'">
                <div class="form-group">
                    <label for="monthly_day" class="block text-sm font-medium text-gray-700">Month Day:</label>
                    <input x-model="selectedMonthDay" type="number" class="mt-1 p-2 block w-full border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 shadow-sm sm:text-sm" id="monthly_day" name="monthly_day" min="1" max="31" placeholder="1">
                    @error('selectedMonthDay')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            {{-- END FREQUENCY --}}
            
            <div class="form-group">
                <label class="block text-sm font-medium text-gray-700">Repetition Options:</label><br>
                <div class="form-check form-check-inline">
                    <input x-model="repetitionOption" class="form-check-input" type="radio" name="repetition_option" id="repetition_by_iterations" value="iterations">
                    <label class="form-check-label" for="repetition_by_iterations">By Iteration</label>
                </div>
                <div class="form-check form-check-inline">
                    <input x-model="repetitionOption" class="form-check-input" type="radio" name="repetition_option" id="repetition_by_dates" value="dates">
                    <label class="form-check-label" for="repetition_by_dates">By Range Date</label>
                </div>
            </div>
            <div class="form-group" x-show="repetitionOption == 'iterations'">
                <label for="repetitions" class="block text-sm font-medium text-gray-700">Iterations:</label>
                <input x-model="iterations" type="number" class="mt-1 p-2 block w-full border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 shadow-sm sm:text-sm" id="repetitions" name="repetitions" min="1" placeholder="Número de repeticiones">
                @error('iterations')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group" x-show="repetitionOption == 'dates'">
                <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date:</label>
                <input x-model="startDate" type="date" class="mt-1 p-2 block w-full border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 shadow-sm sm:text-sm" id="start_date" name="start_date">
                @error('startDate')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group" x-show="repetitionOption == 'dates'">
                <label for="end_date" class="block text-sm font-medium text-gray-700">End Date:</label>
                <input x-model="endDate" type="date" class="mt-1 p-2 block w-full border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 shadow-sm sm:text-sm" id="end_date" name="end_date">
                @error('endDate')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
        
        </div>
    </x-slot>


    <x-slot name="buttons">
        <button 
            type="button" 
            wire:click="saveTask"
            class="focus:outline-none text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 
            me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900"
        >
            {{ $this->id ? 'Update' : 'Save' }}
        </button>
    </x-slot>
</x-modal>
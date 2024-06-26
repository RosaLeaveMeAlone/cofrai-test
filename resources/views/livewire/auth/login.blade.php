
    {{-- <div>
        <h1 class="text-red-500">Hola mundo!</h1>
    </div> --}}

@section('title')
Login
@endsection

@section('subhead')
    <title>Login | Cofrai Test</title>
@endsection

<div class="">
    <form class="space-y-6" wire:submit.prevent="login">
        <div>
            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
            <div class="mt-2">
                <input 
                    id="email" 
                    name="email" 
                    wire:model="email" 
                    type="email" 
                    autocomplete="email" 
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 
                    placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                >
                @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <div class="flex items-center justify-between">
            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
            </div>
            <div class="mt-2">
                <input 
                    id="password" 
                    name="password" 
                    wire:model="password" 
                    type="password" 
                    autocomplete="current-password" 
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 
                    placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                >
                @error('password')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <button 
                type="submit" 
                wire:click="login"
                class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold 
                leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 
                focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
            >
                Sign in
            </button>
        </div>
    </form>

    <p class="mt-10 text-center text-sm text-gray-500">
        Not a member?
        <a href="{{route('admin.register')}}" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Register</a>
    </p>
</div>

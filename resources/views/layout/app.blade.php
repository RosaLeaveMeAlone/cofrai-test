
@extends('../layout/base')

@section('head')
@yield('subhead')
@endsection

<body>
  <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <img class="mx-auto h-10 w-auto" src="https://blade-ui-kit.com/images/livewire.svg" alt="Livewire Logo">
      <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
        @yield('title', 'Inicio de Sesion')
      </h2>
      {{-- <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">{{ $title ?? 'Inicio de Sesion' }}</h2> --}}
      
    </div>
  
    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      {{ $slot }}
    </div>
  </div>
</body>



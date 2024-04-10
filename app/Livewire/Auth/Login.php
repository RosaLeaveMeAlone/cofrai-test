<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;


    // -----------------------------------------------------------------------------------------------------------------
    // @ Rules
    // -----------------------------------------------------------------------------------------------------------------
    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    // -----------------------------------------------------------------------------------------------------------------
    // @ Public Functions
    // -----------------------------------------------------------------------------------------------------------------
    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => strtolower($this->email), 'password' => $this->password])) {
            return redirect()->route('admin.dashboard');
        } 

        $this->addError('email', 'Invalid credentials.');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}

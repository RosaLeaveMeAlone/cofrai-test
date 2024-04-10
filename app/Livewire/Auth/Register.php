<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $email;
    public $name;
    public $password_confirmation;
    public $password;

    // -----------------------------------------------------------------------------------------------------------------
    // @ Rules
    // -----------------------------------------------------------------------------------------------------------------
    protected $rules = [
        'email' => 'required|email|unique:users',
        'name' => 'required|string|min:3',
        'password' => 'required|min:6|confirmed',
    ];

    // -----------------------------------------------------------------------------------------------------------------
    // @ Public Functions
    // -----------------------------------------------------------------------------------------------------------------
    public function registerUser()
    {
        $this->validate();

        $user = User::create([
            'email' => strtolower($this->email),
            'name' => $this->name,
            'password' => Hash::make($this->password),
        ]);

        // auth()->login($user);

        return redirect()->route('admin.login');
    }

    public function render()
    {
        return view('livewire.auth.register')->layout('layout.app');
    }
}

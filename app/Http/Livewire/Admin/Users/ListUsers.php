<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ListUsers extends Component
{
    // public $name;
    // public $email;
    // public $password;
    // public $password_confirmation;
    #instead of declaring multiple properties; you can define state array and use method in view

    public $state = [];
    public $user;
    public $showEditModal = false;

    public function addNew()
    {
        $this->state = [];
        # If we had used the individual input fields then we would need to do something like $this->name = '';
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }

    public function createUser()
    {
        // dd($this->state);
        $validatedData = Validator::make($this->state, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ])->validate();

        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);
        // Session::flash('message', 'User created successfully!');
        $this->dispatchBrowserEvent('hide-form', ['message' => 'User created successfully!']);

        // return redirect()->back();
    }

    public function edit(User $user)
    {
        // dd($user);
        $this->showEditModal = true;
        // dd($user->toArray());
        $this->user = $user;
        $this->state = $user->toArray();
        $this->dispatchBrowserEvent('show-form');
    }

    public function updateUser()
    {
        $validatedData = Validator::make($this->state, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'password' => 'sometimes|confirmed'
        ])->validate();

        if (!empty($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }

        $this->user->update($validatedData);
        $this->dispatchBrowserEvent('hide-form', ['message' => 'User updated successfully!']);
    }

    public function render()
    {
        $users = User::latest()->paginate();
        return view('livewire.admin.users.list-users', [
            'users' => $users,
        ]);
    }
}

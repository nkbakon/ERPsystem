<?php

namespace App\Http\Livewire\Users\Forms;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class CreateForm extends Component
{
    public $type;
    public $fname;
    public $lname;
    public $username;
    public $email;
    public $password;
    public $confirm_password;

    public function mount()
    {
        $this->type = '';
    }
 
    protected $rules = [
        'fname' => 'required',
        'lname' => 'required',
        'username' => 'required|unique:users,username',
        'email' => 'required|email|unique:users,email',
        'type' => 'required',
        'password' => 'required|min:6',
        'confirm_password' => 'required|same:password',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {   
        $validator = Validator::make($this->all(), $this->rules);

        if ($validator->fails()) {
            $this->emit('validationError', $validator->errors()->first());
            return;
        }
        $data['fname'] = $this->fname;
        $data['lname'] = $this->lname;
        $data['username'] = $this->username;
        $data['email'] = $this->email;
        $data['type'] = $this->type;
        $data['password'] = Hash::make($this->password);

        $user = User::create($data);
        if($user){
            return redirect()->route('users.index')->with('status', 'User registered successfully.');  
        }
        return redirect()->route('users.index')->with('delete', 'User registration faild, try again.');       
        
    }
    
    public function render()
    {
        return view('users.components.create-form');
    }
}


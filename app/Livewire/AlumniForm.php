<?php

namespace App\Livewire;

use App\Models\Alumni;
use Livewire\Component;

class AlumniForm extends Component
{
    public $user_id;
    public $student_id;
    public $first_name;
    public $last_name;
    public $middle_name;
    public $birth_date;
    public $gender;
    public $phone;
    public $address;
    public $course;
    public $major;
    public $batch_year;
    public $graduation_date;
    public $gpa;
    public $status = 'unemployed';

    public $genderOptions = [
        ['value' => 'male', 'label' => 'Male'],
        ['value' => 'female', 'label' => 'Female'],
        ['value' => 'other', 'label' => 'Other'],
    ];

    public $statusOptions = [
        ['value' => 'unemployed', 'label' => 'Unemployed'],
        ['value' => 'employed', 'label' => 'Employed'],
        ['value' => 'self_employed', 'label' => 'Self Employed'],
        ['value' => 'further_studies', 'label' => 'Further Studies'],
    ];

    protected $rules = [
        'student_id' => 'required|string|unique:alumnis,student_id',
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'birth_date' => 'required|date',
        'gender' => 'required|string|in:male,female,other',
        'phone' => 'required|string|max:20',
        'address' => 'required|string|max:500',
        'course' => 'required|string|max:255',
        'major' => 'required|string|max:255',
        'batch_year' => 'required|integer|min:1900|max:2030',
        'graduation_date' => 'required|date',
        'gpa' => 'nullable|numeric|min:0|max:5',
        'status' => 'required|in:employed,unemployed,self_employed,further_studies',
    ];

    public function mount()
    {
        $this->user_id = auth()->id();
        $user = auth()->user();
        
        // Prefill name fields from user registration
        if ($user && $user->name) {
            $nameParts = explode(' ', trim($user->name), 2);
            $this->first_name = $nameParts[0] ?? '';
            $this->last_name = $nameParts[1] ?? '';
        }
    }

    public function save()
    {
        $this->validate();

        Alumni::create([
            'user_id' => $this->user_id,
            'student_id' => $this->student_id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'middle_name' => $this->middle_name,
            'birth_date' => $this->birth_date,
            'gender' => $this->gender,
            'phone' => $this->phone,
            'address' => $this->address,
            'course' => $this->course,
            'major' => $this->major,
            'batch_year' => $this->batch_year,
            'graduation_date' => $this->graduation_date,
            'gpa' => $this->gpa,
            'status' => $this->status,
        ]);

        // Update user role to alumni
        auth()->user()->update(['role' => 'alumni']);

        session()->flash('message', 'Alumni profile created successfully!');
        
        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.alumni-form');
    }
}

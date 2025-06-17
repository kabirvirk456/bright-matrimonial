<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Profile;

class FindMatchSection extends Component
{
    public $filters = [
        'Religion'     => ['Hindu', 'sikh', 'muslim'],
        'Caste'        => ['Aggarwal', 'Jat', 'Khatri'],
        'City'         => ['Mumbai'],
        // Add as needed
    ];

    public $activeTab = 'Religion';
    public $activeCategory = 'Hindu';
    public $profiles = [];

    public function mount()
    {
        $this->activeCategory = $this->filters[$this->activeTab][0] ?? null;
        $this->updateProfiles();
    }

    public function selectTab($tab)
    {
        $this->activeTab = $tab;
        $this->activeCategory = $this->filters[$tab][0] ?? null;
        $this->updateProfiles();
    }

    public function selectCategory($category)
    {
        $this->activeCategory = $category;
        $this->updateProfiles();
    }

    public function updateProfiles()
    {
        $query = Profile::query();

        if ($this->activeTab === 'Religion') {
            $id = \App\Models\Religion::where('name', $this->activeCategory)->value('id');
            if ($id) $query->where('religion_id', $id);
        } elseif ($this->activeTab === 'Caste') {
            $id = \App\Models\Caste::where('name', $this->activeCategory)->value('id');
            if ($id) $query->where('caste_id', $id);
        } elseif ($this->activeTab === 'City') {
            $id = \App\Models\City::where('name', $this->activeCategory)->value('id');
            if ($id) $query->where('city_id', $id);
        }

        // Eager load everything needed for cards!
        $this->profiles = $query->with(['user', 'religion', 'caste', 'city'])->limit(9)->get();
    }

    public function render()
    {
        return view('livewire.find-match-section');
    }
}

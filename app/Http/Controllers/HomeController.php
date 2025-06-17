<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $filters = [
            'Caste' => ['Aggarwal', 'Kanyakubj', 'Brahmin', 'Gaur Brahmin', 'Brahmin Jat', 'Kayastha', 'Khatri'],
            'Religion' => ['Hindu', 'Muslim', 'Sikh', 'Christian'],
            'City' => ['Mumbai', 'Delhi', 'Bangalore', 'Hyderabad'],
            'Occupation' => ['Doctor', 'Engineer', 'Business', 'Teacher'],
        ];
        $activeTab = $request->get('tab', 'Caste');
        $activeCategory = $request->get('category', $filters[$activeTab][0] ?? null);

        $profiles = Profile::query()
            ->when($activeTab == 'Caste', fn($q) => $q->where('caste', $activeCategory))
            ->when($activeTab == 'Religion', fn($q) => $q->where('religion', $activeCategory))
            ->when($activeTab == 'City', fn($q) => $q->where('city', $activeCategory))
            ->when($activeTab == 'Occupation', fn($q) => $q->where('occupation', $activeCategory))
            ->limit(9)->get();

        return view('welcome', compact('filters', 'activeTab', 'activeCategory', 'profiles'));
    }
}

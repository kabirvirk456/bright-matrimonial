<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Profile;
use App\Models\Hobby;
use App\Models\FavoriteMusic;
use App\Models\FavoriteBook;
use App\Models\FavoriteMovie;
use App\Models\FavoriteSport;
use App\Models\Religion;
use App\Models\Caste;
use App\Models\State;
use App\Models\City;
use App\Models\MotherTongue;
use Aws\Rekognition\RekognitionClient;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user->profile) {
            $profile = new Profile();
            $profile->user_id = $user->id;
            $profile->save();
            $user->refresh();
        }
        return $this->showPersonalInfo();
    }

    public function showPersonalInfo()
    {
        $user = auth()->user();
        $profile = $user->profile;

        $religions = Religion::orderBy('name')->pluck('name', 'id');
        $castes = Caste::orderBy('name')->pluck('name', 'id');
        $states = State::orderBy('name')->pluck('name', 'id');
        $cities = City::orderBy('name')->pluck('name', 'id');
        $motherTongues = MotherTongue::orderBy('name')->pluck('name', 'id');

        return view('profile.personal-info', compact(
            'profile', 'user', 'religions', 'castes', 'states', 'cities', 'motherTongues'
        ));
    }

    public function updatePersonalInfo(Request $request)
    {
        $data = $request->validate([
            'religion_id' => 'nullable|exists:religions,id',
            'caste_id' => 'nullable|exists:castes,id',
            'state_id' => 'nullable|exists:states,id',
            'city_id' => 'nullable|exists:cities,id',
            'mother_tongue_id' => 'nullable|exists:mother_tongues,id',
            'hobby_id' => 'nullable|exists:hobbies,id',
            'live_with_family' => 'nullable|in:0,1',
            'marital_status' => 'nullable|string',
            'diet' => 'nullable|string',
            'height' => 'nullable|string',
            'weight' => 'nullable|string',
            'about' => 'nullable|string',
        ]);

        if (array_key_exists('live_with_family', $data)) {
            $data['live_with_family'] = $data['live_with_family'] == '1' ? 1 : 0;
        }

        $profile = Auth::user()->profile ?? new Profile(['user_id' => Auth::id()]);
        $profile->fill($data);
        $profile->save();

        return back()->with('success', 'Personal information updated!');
    }

    // Matches
    public function browse(Request $request)
    {
        $matches = Profile::with('user')
            ->when($request->member_id, fn($q) => $q->whereHas('user', fn($u) => $u->where('id', $request->member_id)))
            ->when($request->gender, fn($q) => $q->where('gender', $request->gender))
            ->when($request->marital_status, fn($q) => $q->where('marital_status', $request->marital_status))
            ->when($request->religion, fn($q) => $q->where('religion', $request->religion))
            ->when($request->caste, fn($q) => $q->where('caste', 'like', '%' . $request->caste . '%'))
            ->when($request->state, fn($q) => $q->where('state', 'like', '%' . $request->state . '%'))
            ->when($request->city, fn($q) => $q->where('city', 'like', '%' . $request->city . '%'))
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('matches.index', compact('matches'));
    }

    public function view($id)
    {
        $profile = Profile::with('user')->where('user_id', $id)->firstOrFail();
        return view('profile.view', compact('profile'));
    }

    // Education & Career
    public function showEducationCareer()
    {
        $profile = Auth::user()->profile ?? new Profile();
        $user = Auth::user();
        return view('profile.education-career', compact('profile', 'user'));
    }

    public function updateEducationCareer(Request $request)
    {
        $data = $request->validate([
            'highest_qualification' => 'nullable|string|max:150',
            'company_name' => 'nullable|string|max:150',
            'income' => 'nullable|string|max:100',
            'company_position' => 'nullable|string|max:100',
        ]);

        $profile = Auth::user()->profile ?? new Profile(['user_id' => Auth::id()]);
        $profile->fill($data);
        $profile->save();

        return back()->with('success', 'Education and career updated!');
    }

    // Family Details
    public function showFamilyDetails()
    {
        $profile = Auth::user()->profile ?? new Profile();
        $user = Auth::user();
        return view('profile.family-details', compact('profile', 'user'));
    }

    public function updateFamilyDetails(Request $request)
    {
        $data = $request->validate([
            'caste' => 'nullable|string',
            'family_type' => 'nullable|string',
            'mother_occupation' => 'nullable|string',
            'father_occupation' => 'nullable|string',
            'siblings' => 'nullable|integer',
        ]);

        $profile = Auth::user()->profile ?? new Profile(['user_id' => Auth::id()]);
        $profile->fill($data);
        $profile->save();

        return back()->with('success', 'Family details updated!');
    }

    // Lifestyle
    public function showLifestyle()
    {
        $profile = Auth::user()->profile ?? new Profile();
        $user = Auth::user();
        return view('profile.lifestyle', compact('profile', 'user'));
    }

    public function updateLifestyle(Request $request)
    {
        $data = $request->validate([
            'drinking_habits'   => 'nullable|string',
            'smoking_habits'    => 'nullable|string',
            'open_to_pets'      => 'nullable|string',
            'languages_spoken'  => 'nullable|array',
        ]);

        if (isset($data['languages_spoken'])) {
            $data['languages_spoken'] = $data['languages_spoken'];
        }

        $profile = Auth::user()->profile ?? new Profile(['user_id' => Auth::id()]);
        $profile->fill($data);
        $profile->save();

        return back()->with('success', 'Lifestyle updated!');
    }

    // Horoscope
    public function showHoroscope()
    {
        $profile = Auth::user()->profile ?? new Profile();
        $user = Auth::user();
        return view('profile.horoscope', compact('profile', 'user'));
    }

    public function updateHoroscope(Request $request)
    {
        $data = $request->validate([
            'birth_place' => 'nullable|string|max:150',
            'birth_date' => 'nullable|date',
            'birth_time' => 'nullable|string|max:20',
            'zodiac_sign' => 'nullable|string|max:50',
            'manglik_dosh' => 'nullable|string|max:50',
        ]);

        $profile = Auth::user()->profile ?? new Profile(['user_id' => Auth::id()]);
        $profile->fill($data);
        $profile->save();

        return back()->with('success', 'Horoscope updated!');
    }

    // Likes
    public function showLikes()
    {
        $profile = Auth::user()->profile ?? new Profile();
        $user = Auth::user();

        $hobbyList   = Hobby::orderBy('name')->pluck('name', 'id');
        $musicList   = FavoriteMusic::orderBy('name')->pluck('name', 'id');
        $bookList    = FavoriteBook::orderBy('name')->pluck('name', 'id');
        $movieList   = FavoriteMovie::orderBy('name')->pluck('name', 'id');
        $sportList   = FavoriteSport::orderBy('name')->pluck('name', 'id');

        return view('profile.likes', compact(
            'profile', 'user', 'hobbyList', 'musicList', 'bookList', 'movieList', 'sportList'
        ));
    }

    public function updateLikes(Request $request)
    {
        $data = $request->validate([
            'hobbies' => 'nullable|string',
            'favorite_music' => 'nullable|string',
            'favorite_books' => 'nullable|string',
            'favorite_movies' => 'nullable|string',
            'favorite_sports' => 'nullable|string',
        ]);

        $profile = Auth::user()->profile ?? new Profile(['user_id' => Auth::id()]);
        $profile->fill($data);
        $profile->save();

        return back()->with('success', 'Likes updated!');
    }

    // Desired Partner
    public function showDesiredPartner()
    {
        $profile = Auth::user()->profile ?? new Profile();
        $user = Auth::user();
        return view('profile.desired-partner', compact('profile', 'user'));
    }

    public function updateDesiredPartner(Request $request)
    {
        $data = $request->validate([
            'desired_age' => 'nullable|string',
            'desired_relation_type' => 'nullable|string',
            'desired_religion' => 'nullable|string',
            'desired_mother_tongue' => 'nullable|string',
            'desired_diet' => 'nullable|string',
            'desired_state' => 'nullable|string',
            'desired_city' => 'nullable|string',
            'desired_highest_qualification' => 'nullable|string',
            'desired_income' => 'nullable|string',
        ]);

        $profile = Auth::user()->profile ?? new Profile(['user_id' => Auth::id()]);
        $profile->fill($data);
        $profile->save();

        return back()->with('success', 'Desired partner updated!');
    }

    // ================== PHOTO UPLOAD/SELFIE/VERIFY FLOW ==================

    // 1. Upload profile photo (profile_photos/)
    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|max:2048',
        ]);
        $user = auth()->user();
        $profile = $user->profile;
        $path = $request->file('profile_photo')->store('profile_photos', 'public');
        $user->profile_photo_path = $path;
        $user->save();
        $profile->photo_path = $path;
        $profile->save();
        return back()->with('success', 'Profile photo uploaded! Next, capture and upload your selfie below.');
    }

    // 2. Save selfie (selfie_photos/)
    public function saveSelfie(Request $request)
    {
        logger('==== saveSelfie CALLED ====');
    logger('User ID in saveSelfie: ' . (auth()->check() ? auth()->id() : 'not logged in'));
    logger('selfie_photo value: ' . substr($request->input('selfie_photo'), 0, 40));
        $request->validate([
            'selfie_photo' => 'required|string',
        ]);
        $user = auth()->user();
        $data = $request->input('selfie_photo');
        $data = preg_replace('/^data:image\/\w+;base64,/', '', $data);
        $imageData = base64_decode($data);
        $filename = 'selfie_' . $user->id . '_' . time() . '.png';
        $path = 'selfie_photos/' . $filename; // <- use selfie_photos/

        Storage::disk('public')->put($path, $imageData);

        $user->selfie_photo_path = $path;
        $user->photo_verification_status = 'pending';
        $user->photo_similarity = null;
        $user->save();

        return back()->with('success', 'Selfie uploaded! Now, click the Verify button below to complete verification.');
    }

    // 3. Photo verification with AWS Rekognition
    public function verifyPhoto(Request $request)
    {
        $user = auth()->user();

        if (env('APP_DEBUG')) {
            logger()->debug('profile_photo_path: ' . $user->profile_photo_path);
            logger()->debug('selfie_photo_path: ' . $user->selfie_photo_path);
        }

        if (!$user->profile_photo_path || !$user->selfie_photo_path) {
            return back()->with('error', 'Please upload both a profile photo and a selfie.');
        }

        try {
            $client = new RekognitionClient([
                'region' => env('AWS_DEFAULT_REGION', 'ap-south-1'),
                'version' => 'latest',
                'credentials' => [
                    'key' => env('AWS_ACCESS_KEY_ID'),
                    'secret' => env('AWS_SECRET_ACCESS_KEY'),
                ],
            ]);

            $profilePhoto = Storage::disk('public')->get($user->profile_photo_path);
            $selfiePhoto  = Storage::disk('public')->get($user->selfie_photo_path);

            $result = $client->compareFaces([
                'SourceImage' => ['Bytes' => $profilePhoto],
                'TargetImage' => ['Bytes' => $selfiePhoto],
                'SimilarityThreshold' => 80,
            ]);

            $similarity = 0;
            if (!empty($result['FaceMatches'])) {
                $similarity = $result['FaceMatches'][0]['Similarity'];
            }

            $user->photo_similarity = $similarity;
            if ($similarity >= 80) {
                $user->photo_verification_status = 'verified';
                $msg = 'Photo verified! (Similarity: '.round($similarity, 2).'%)';
            } else {
                $user->photo_verification_status = 'rejected';
                $msg = 'Verification failed. Similarity: '.round($similarity, 2).'%. Please re-upload clearer images.';
            }
            $user->save();

            return back()->with('success', $msg);

        } catch (\Exception $e) {
            return back()->with('error', 'AWS Rekognition Error: ' . $e->getMessage());
        }
    }

    // ...other methods for section navigation, edit, etc. remain unchanged
}

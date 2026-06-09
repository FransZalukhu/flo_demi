<?php

namespace App\Http\Controllers\Mentee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Services\ImageUploadService;

use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    protected $imageService;

    public function __construct(ImageUploadService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Show the mentee profile page.
     */
    public function index()
    {
        $user = Auth::user();
        return view('mentee.profil.profil', compact('user'));
    }

    /**
     * Update the mentee profile.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'nomor_hp' => 'nullable|string|max:20',
            'photo'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|string|min:8',
        ]);

        $data = [
            'username' => $request->username,
            'email'    => $request->email,
            'nomor_hp' => $request->nomor_hp,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('photo')) {
            $path = $this->imageService->upload(
                $request->file('photo'),
                'profile-photos',
                400,
                80,
                $user->photo
            );
            $data['photo'] = $path;
        }

        User::where('id', $user->id)->update($data);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}

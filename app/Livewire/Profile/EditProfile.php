<?php

namespace App\Livewire\Profile;

use App\Services\ImageService;
use App\Traits\HasImages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditProfile extends Component
{
    use WithFileUploads, HasImages;

    public $name;
    public $email;
    public $photo;
    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    protected ImageService $imageService;

    public function boot(ImageService $imageService): void
    {
        $this->imageService = $imageService;
    }

    public function mount(): void
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function updatedPhoto(): void
    {
        $this->validate([
            'photo' => ['required', 'image', 'max:2048', 'mimes:jpeg,jpg,png,webp'],
        ], [
            'photo.image' => 'Le fichier doit être une image.',
            'photo.max' => 'L\'image ne doit pas dépasser 2 Mo.',
            'photo.mimes' => 'L\'image doit être au format JPEG, PNG ou WebP.',
        ]);

        $this->savePhoto();
    }

    public function savePhoto(): void
    {
        if (!$this->photo) {
            return;
        }

        $user = Auth::user();

        if ($user->profile_picture) {
            $this->deleteImage($user->profile_picture);
        }

        $uuid = $this->uploadImage($this->photo);
        $user->profile_picture = $uuid;
        $user->save();

        $this->photo = null;

        $this->dispatch('notifyAlert', message: 'Photo de profil mise à jour avec succès.', type: 'success');


    }

    public function updateProfile(): void
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
        ]);

        $user = Auth::user();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->save();

        $this->dispatch('notifyAlert', message: 'Profil mis à jour avec succès.', type: 'success');

    }

    public function updatePassword(): void
    {
        $this->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', Password::defaults(), 'confirmed'],
        ], [
            'current_password.current_password' => 'Le mot de passe actuel est incorrect.',
            'new_password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
        ]);

        $user = Auth::user();
        $user->password = Hash::make($this->new_password);
        $user->save();

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);

        $this->dispatch('notifyAlert', message: 'Mot de passe modifié avec succès', type: 'success');

    }

    public function removeProfilePicture(): void
    {
        $user = Auth::user();

        if ($user->profile_picture) {
            $this->deleteImage($user->profile_picture);
            $user->profile_picture = null;
            $user->save();

            $this->dispatch('notifyAlert', message: 'Photo de profil supprimée', type: 'success');

        }
    }

    public function render()
    {
        return view('livewire.profile.edit-profile');
    }
}

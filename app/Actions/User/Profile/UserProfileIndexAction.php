<?php

namespace App\Actions\User\Profile;

use App\Repositories\User\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserProfileIndexAction
{
    public function __construct(
        protected UserRepository $repository,
    ){}

    public function handle(int $id): View|RedirectResponse
    {
        $user = $this->repository->findById($id);

        if (!$user) {
            session()->flash('error', 'User not found');
            return redirect()->back();
        }

        return view('user.profile.index', compact('user'));
    }
}

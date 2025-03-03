<?php

namespace App\Http\Controllers\User;

use App\Actions\User\Profile\UserProfileIndexAction;
use App\Actions\User\Profile\UserProfileStoreAction;
use App\Exceptions\User\Profile\UserProfileUpdateException;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Profile\UserProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Throwable;

class UserController extends Controller
{
    public function index(UserProfileIndexAction $action, int $id)
    {
        return $action->handle($id);
    }

    /**
     * @throws Throwable
     * @throws UserProfileUpdateException
     */
    public function store(UserProfileUpdateRequest $request, UserProfileStoreAction $action)
    {
        return $action->handle($request->validated());
    }

    public function password(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        if (Hash::check($request->current_password, auth()->user()->password)) {

            auth()->user()->update([
                'password' => Hash::make($request->password)
            ]);

            session()->flash('success', __('success.user.password-update.success'));
        } else {
            session()->flash('error', __('errors.user.password-change'));
        }

        return back();
    }
}

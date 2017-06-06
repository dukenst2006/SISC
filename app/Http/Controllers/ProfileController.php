<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends UserController
{
    /**
     * Show the user's profile.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = $this->user;
        $user_role = $this->user->role->name;

        return view('user/profile')->with(['user' => $user, 'user_role' => $user_role]);
    }

    /**
     * Handle the profile update.
     *
     * @param StoreUserInfo $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreUserInfo $request)
    {
        $user = Auth::user();

        if ($user->update($request->all())) {
            $message['success'] = 'Your information has been updated!';
        } else {
            $message['error'] = 'An error occurred while saving your info. Please try again.';
        }

        return back()->with($message);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required|min:6',
            'new_password'     => 'required|min:6|confirmed',
        ]);

        if (Hash::check($request->current_password, $this->user->password)) {
            $user = Auth::user();
            $user->password = bcrypt($request->password);

            if ($user->save()) {
                $message = ['success' => 'Your password has been changed!'];
            } else {
                $message = ['error' => 'It was not possible to change your password. Try again.'];
            }
        } else {
            $message = ['error' => 'The password you entered was not correct.'];
        }

        return back()->with($message);
    }
}

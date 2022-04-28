<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\StoreGuestUserRequest;
use App\Models\GuestUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GuestUserController extends Controller
{
    public function create(): View
    {
        return view('public.guest.create');
    }

    public function store(StoreGuestUserRequest $request): RedirectResponse
    {
        $guest = GuestUser::firstOrCreate([
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
        ]);

        session(['guest' => $guest->id]);

        return redirect()->route('questionnaires.type-list');
    }
}

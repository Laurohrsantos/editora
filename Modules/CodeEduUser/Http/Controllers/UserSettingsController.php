<?php

namespace CodeEduUser\Http\Controllers;

use CodeEduUser\Http\Requests\UserSettingRequest;
use CodeEduUser\Repositories\UserRepository;

class UserSettingsController extends Controller
{

    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * UsersController constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Show the form for editing the specified resource.
     * @return \Illuminate\Http\Response
     * @internal param $user
     * @internal param int $id
     */
    public function edit()
    {
        $user = \Auth::user();
        return view('codeeduuser::user-settings.setting', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserSettingRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @internal param $id
     * @internal param int $id
     */
    public function update(UserSettingRequest $request)
    {
        $user = \Auth::user();
        $this->repository->update($request->all(), $user->id);
        $request->session()->flash('message', 'usuário alterado com sucesso.');

        return redirect()->route('codeeduuser.user_settings.edit');
    }

    public function profile()
    {
        $user = \Auth::user();
        return view('codeeduuser::user-settings.profile', compact('user'));
    }
}

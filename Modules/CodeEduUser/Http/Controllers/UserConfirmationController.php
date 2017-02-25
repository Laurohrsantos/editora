<?php

namespace CodeEduUser\Http\Controllers;

use CodeEduUser\Repositories\UserRepository;
use Jrean\UserVerification\Traits\VerifiesUsers;

class UserConfirmationController extends Controller
{

    use VerifiesUsers;

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

    public function redirectAfterVerification()
    {
        $this->loginUser();
        \Session::flash('message', 'Crie uma senha para poder logar normalmente no sistema.');

        return route('codeeduuser.user_settings.edit');
    }

    private function loginUser()
    {
        $email = \Request::get('email');
        $user = $this->repository->findByField('email', $email)->first();
        \Auth::login($user);
    }

    public function redirectIfVerificationFails()
    {
        \Auth::logout();
        return route('codeeduuser.email-verification.error');
    }


}

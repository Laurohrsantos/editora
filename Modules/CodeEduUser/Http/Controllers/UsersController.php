<?php

namespace CodeEduUser\Http\Controllers;

use CodeEduUser\Http\Requests\UserDeleteRequest;
use CodeEduUser\Models\User;
use CodeEduUser\Http\Requests\UserRequest;
use CodeEduUser\Repositories\UserRepository;
use Illuminate\Http\Request;

class UsersController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->repository->paginate(10);

        return view('codeeduuser::users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('codeeduuser::users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $this->repository->create($request->all());
        $url = $request->get('redirect_to', route('codeeduuser.users.index'));
        $request->session()->flash('message', 'usuário Cadastrado com Sucesso.');

        return redirect()->to($url);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show(User $user)
    {
        return view('codeeduuser::users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(User $user)
    {
        return view('codeeduuser::users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest|Request $request
     * @param $id
     * @internal param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, $id)
    {
        $data = $request->except(['password']);
        $this->repository->update($data, $id);
        $request->session()->flash('message', 'usuário alterado com sucesso.');
        $url = $request->get('redirect_to', route('codeeduuser.users.index'));

        return redirect()->to($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserDeleteRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param User $user
     * @internal param int $id
     */
    public function destroy(UserDeleteRequest $request, $id)
    {
        $this->repository->delete($id);
        \Session::flash('message', 'usuário deletado com sucesso.');

        return redirect()->route('codeeduuser.users.index');
    }
}

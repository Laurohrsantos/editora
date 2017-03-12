<?php

namespace CodeEduUser\Http\Controllers;

use CodeEduUser\Http\Requests\UserDeleteRequest;
use CodeEduUser\Models\User;
use CodeEduUser\Http\Requests\UserRequest;
use CodeEduUser\Repositories\RoleRepository;
use CodeEduUser\Repositories\UserRepository;
use Illuminate\Http\Request;
use CodeEduUser\Annotations\Mapping as Permission;

/**
 * @Permission\Controller(name="users-admin", description="Administração de usuários")
 */
class UsersController extends Controller
{
    /**
     * @var UserRepository
     */
    private $repository;
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * UsersController constructor.
     * @param UserRepository $repository
     * @param RoleRepository $roleRepository
     */
    public function __construct(UserRepository $repository, RoleRepository $roleRepository)
    {
        $this->repository = $repository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @Permission\Action(name="list", description="Ver listagem de usuários.")
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
     * @Permission\Action(name="store", description="Criar usuários.")
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->roleRepository->all()->pluck('name', 'id');
        return view('codeeduuser::users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @Permission\Action(name="store", description="Criar usuários.")
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
     * @Permission\Action(name="delete", description="Deletar usuários.")
     * @param User $user
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show(User $user)
    {
        $roles = $this->roleRepository->all()->pluck('name', 'id');
        return view('codeeduuser::users.show', compact('user', 'roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @Permission\Action(name="update", description="Alterar usuários.")
     * @param User $user
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(User $user)
    {
        $roles = $this->roleRepository->all()->pluck('name', 'id');
        return view('codeeduuser::users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @Permission\Action(name="update", description="Alterar usuários.")
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
     * @Permission\Action(name="delete", description="Excluir usuários.")
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

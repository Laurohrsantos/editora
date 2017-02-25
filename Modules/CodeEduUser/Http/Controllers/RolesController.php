<?php

namespace CodeEduUser\Http\Controllers;

use CodeEduUser\Http\Requests\RoleRequest;
use CodeEduUser\Models\Role;
use CodeEduUser\Repositories\RoleRepository;
use CodeEduUser\Repositories\UserRepository;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * UsersController constructor.
     * @param RoleRepository|UserRepository $repository
     */
    public function __construct(RoleRepository $repository)
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
        $roles = $this->repository->paginate(10);

        return view('codeeduuser::roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('codeeduuser::roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $this->repository->create($request->all());
        $url = $request->get('redirect_to', route('codeeduuser.roles.index'));
        $request->session()->flash('message', 'Função Cadastrada com Sucesso.');

        return redirect()->to($url);
    }

    /**
     * Display the specified resource.
     *
     * @param Role $role
     * @return \Illuminate\Http\Response
     * @internal param Role $user
     * @internal param int $id
     */
    public function show(Role $role)
    {
        return view('codeeduuser::roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @return \Illuminate\Http\Response
     * @internal param Role $user
     * @internal param int $id
     */
    public function edit(Role $role)
    {
        return view('codeeduuser::roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoleRequest|Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @internal param int $id
     */
    public function update(RoleRequest $request, $id)
    {
        $this->repository->update($request->all(), $id);
        $request->session()->flash('message', 'Função alterada com sucesso.');
        $url = $request->get('redirect_to', route('codeeduuser.roles.index'));

        return redirect()->to($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param RoleRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param User $user
     * @internal param int $id
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        \Session::flash('message', 'Função deletada com sucesso.');

        return redirect()->route('codeeduuser.roles.index');
    }
}

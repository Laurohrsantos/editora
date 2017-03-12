<?php

namespace CodeEduUser\Http\Controllers;

use CodeEduUser\Criteria\FindPermissionsGroupCriteria;
use CodeEduUser\Http\Requests\PermissionRequest;
use CodeEduUser\Http\Requests\RoleRequest;
use CodeEduUser\Models\Role;
use CodeEduUser\Repositories\PermissionRepository;
use CodeEduUser\Repositories\RoleRepository;
use CodeEduUser\Repositories\UserRepository;
use CodeEduUser\Criteria\FindPermissionsResourceCriteria;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use CodeEduUser\Annotations\Mapping as Permission;

/**
 * @Permission\Controller(name="roles-admin", description="Administração de funções")
 */
class RolesController extends Controller
{
    /**
     * @var UserRepository
     */
    private $repository;
    /**
     * @var PermissionRepository
     */
    private $permissionRepository;

    /**
     * UsersController constructor.
     * @param RoleRepository|UserRepository $repository
     * @param PermissionRepository $permissionRepository
     */
    public function __construct(RoleRepository $repository, PermissionRepository $permissionRepository)
    {
        $this->repository = $repository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @Permission\Action(name="list", description="Ver listagem de funções.")
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
     * @Permission\Action(name="store", description="Criar funções de usuários.")
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('codeeduuser::roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @Permission\Action(name="store", description="Criar funções de usuários.")
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
     * @Permission\Action(name="delete", description="Deletar funções funções de usuários.")
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
     * @Permission\Action(name="update", description="Alterar funções funções de usuários.")
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
     * @Permission\Action(name="update", description="Alterar funções funções de usuários.")
     * @param RoleRequest|Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @internal param int $id
     */
    public function update(RoleRequest $request, $id)
    {
        $data = $request->except('permissions');
        $this->repository->update($data, $id);
        $request->session()->flash('message', 'Função alterada com sucesso.');
        $url = $request->get('redirect_to', route('codeeduuser.roles.index'));

        return redirect()->to($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @Permission\Action(name="delete", description="Deletar funções funções de usuários.")
     * @param RoleRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param RoleRequest $request
     * @internal param User $user
     * @internal param int $id
     */
    public function destroy(RoleRequest $request, $id)
    {
        try {
            $this->repository->delete($id);
            \Session::flash('message', 'Função deletada com sucesso.');
        } catch (QueryException $ex) {
            \Session::flash('error', 'Papel de usuário não pode ser excluido.');
        }

        return redirect()->route('codeeduuser.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @Permission\Action(name="update-permission", description="Atribuir funções de usuários aos cargos.")
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPermission($id)
    {
        $role = $this->repository->find($id);
        $this->permissionRepository->pushCriteria(new FindPermissionsResourceCriteria());
        $permissions = $this->permissionRepository->all();

        $this->permissionRepository->resetCriteria();
        $this->permissionRepository->pushCriteria(new FindPermissionsGroupCriteria());
        $permissionsGroup = $this->permissionRepository->all(['name', 'description']);

        return view('codeeduuser::roles.permissions', compact('role', 'permissions', 'permissionsGroup'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @Permission\Action(name="update-permission", description="Atribuir funções de usuários aos cargos.")
     * @param PermissionRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePermission(PermissionRequest $request, $id)
    {
        $data = $request->only('permissions');
        $this->repository->update($data, $id);
        $request->session()->flash('message', 'Permissões atribuidas com sucesso.');
        $url = $request->get('redirect_to', route('codeeduuser.roles.index'));

        return redirect()->to($url);
    }
}

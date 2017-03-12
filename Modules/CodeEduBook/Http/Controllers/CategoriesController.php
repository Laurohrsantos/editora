<?php

namespace CodeEduBook\Http\Controllers;

use CodeEduBook\Models\Category;
use CodeEduBook\Http\Requests\CategoryRequest;
use CodeEduBook\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use CodeEduUser\Annotations\Mapping as Permission;

/**
 * @Permission\Controller(name="category-permission", description="Administração de categorias")
 */
class CategoriesController extends Controller
{
    /**
     * @var CategoryRepository
     */
    private $repository;

    /**
     * CategoriesController constructor.
     * @param CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @Permission\Action(name="list", description="Ver listagem de categorias.")
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->repository->paginate(10);

        return view('codeedubook::categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @Permission\Action(name="store", description="Criação de categorias.")
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('codeedubook::categories/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @Permission\Action(name="store", description="Criação de categorias.")
     * @param CategoryRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $this->repository->create($request->all());
        $url = $request->get('redirect_to', route('categories.index'));
        $request->session()->flash('message', 'Categoria Cadastrada com Sucesso.');

        return redirect()->to($url);
    }

    /**
     * Display the specified resource.
     *
     * @Permission\Action(name="delete", description="Exclusão de categorias.")
     * @param Category $category
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show(Category $category)
    {
        return view('codeedubook::categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @Permission\Action(name="update", description="Edição de categorias.")
     * @param Category $category
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(Category $category)
    {
        return view('codeedubook::categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @Permission\Action(name="update", description="Edição de categorias.")
     * @param CategoryRequest|Request $request
     * @param $id
     * @internal param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryRequest $request, $id)
    {
        $this->repository->update($request->all(), $id);
        $request->session()->flash('message', 'Categoria alterada com sucesso.');
        $url = $request->get('redirect_to', route('categories.index'));

        return redirect()->to($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @Permission\Action(name="delete", description="Exclusão de categorias.")
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param Category $category
     * @internal param int $id
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        \Session::flash('message', 'Categoria deletada com Sucesso.');

        return redirect()->route('categories.index');
    }
}

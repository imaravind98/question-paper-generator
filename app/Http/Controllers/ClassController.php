<?php

namespace App\Http\Controllers;

use App\Repositories\ClassRepository;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    protected $classRepository;

    /**
     * Constructor to bind repository to controller.
     *
     * @param ClassRepository $classRepository
     */
    public function __construct(ClassRepository $classRepository)
    {
        $this->classRepository = $classRepository;
    }

    /**
     * Display a listing of the classes.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $classList = $this->classRepository->list($request['size']);
        if ($request['search']) {
            $classList = $this->classRepository->search($request['search'], $request['size']);
        }
        return Inertia::render('Classes/Index', ['classList' => $classList]);
    }

    /**
     * Show the form for creating a new class.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Classes/Create');
    }

    /**
     * Store a newly created class in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $this->classRepository->create($data);

        return true;
    }

    /**
     * Display the specified class.
     *
     * @param int $id
     * @return \Inertia\Response
     */
    public function show($id)
    {
        $class = $this->classRepository->find($id);
        return Inertia::render('Classes/Show', ['classData' => $class]);
    }

    /**
     * Show the form for editing the specified class.
     *
     * @param int $id
     * @return \Inertia\Response
     */
    public function edit($id)
    {
        $class = $this->classRepository->find($id);
        return Inertia::render('Classes/Edit', ['classData' => $class]);
    }

    /**
     * Update the specified class in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $this->classRepository->update($id, $data);

        return true;
    }

    /**
     * Remove the specified class from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->classRepository->delete($id);

        return true;
    }
}

<?php

namespace App\Http\Controllers;

use App\Repositories\SubjectRepository;
use Inertia\Inertia;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    protected $subJectRepository;

    /**
     * Constructor to bind repository to controller.
     *
     * @param SubjectRepository $subJectRepository
     */
    public function __construct(SubjectRepository $subJectRepository)
    {
        $this->subJectRepository = $subJectRepository;
    }

    /**
     * Display a listing of the Subjects.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $SubjectList = $this->subJectRepository->list($request['size']);
        if ($request['search']) {
            $SubjectList = $this->subJectRepository->search($request['search'], $request['size']);
        }

        return Inertia::render('Subjects/Index', [
            'subjectList' => $SubjectList,
        ]);
    }

    /**
     * Show the form for creating a new Subject.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Subjects/Create');
    }

    /**
     * Store a newly created Subject in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $this->subJectRepository->create($data);

        return true;
    }

    /**
     * Display the specified Subject.
     *
     * @param int $id
     * @return \Inertia\Response
     */
    public function show($id)
    {
        $Subject = $this->subJectRepository->find($id);
        return Inertia::render('Subjects/Show', ['subject' => $Subject]);
    }

    /**
     * Show the form for editing the specified Subject.
     *
     * @param int $id
     * @return \Inertia\Response
     */
    public function edit($id)
    {
        $Subject = $this->subJectRepository->find($id);
        return Inertia::render('Subjects/Edit', ['subject' => $Subject]);
    }

    /**
     * Update the specified Subject in storage.
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

        $this->subJectRepository->update($id, $data);

        return true;
    }

    /**
     * Remove the specified Subject from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->subJectRepository->delete($id);

        return true;
    }
}

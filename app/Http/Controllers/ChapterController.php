<?php

namespace App\Http\Controllers;

use App\Repositories\ChapterRepository;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    protected $chapterRepository;

    /**
     * Constructor to bind repository to controller.
     *
     * @param ChapterRepository $chapterRepository
     */
    public function __construct(ChapterRepository $chapterRepository)
    {
        $this->chapterRepository = $chapterRepository;
    }

    /**
     * Display a listing of the chapters.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $chapterList = $this->chapterRepository->list($request['size']);
        if ($request['search']) {
            $chapterList = $this->chapterRepository->search($request['search'], $request['size']);
        }
        return Inertia::render('Chapters/Index', ['chapterList' => $chapterList]);
    }

    /**
     * Show the form for creating a new chapter.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Chapters/Create');
    }

    /**
     * Store a newly created chapter in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $this->chapterRepository->create($data);

        return true;
    }

    /**
     * Display the specified chapter.
     *
     * @param int $id
     * @return \Inertia\Response
     */
    public function show($id)
    {
        $chapter = $this->chapterRepository->find($id);
        return Inertia::render('Chapters/Show', ['chapter' => $chapter]);
    }

    /**
     * Show the form for editing the specified chapter.
     *
     * @param int $id
     * @return \Inertia\Response
     */
    public function edit($id)
    {
        $chapter = $this->chapterRepository->find($id);
        return Inertia::render('Chapters/Edit', ['chapter' => $chapter]);
    }

    /**
     * Update the specified chapter in storage.
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

        $this->chapterRepository->update($id, $data);

        return true;
    }

    /**
     * Remove the specified chapter from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->chapterRepository->delete($id);

        return true;
    }
}

<?php

namespace App\Http\Controllers;

use App\Repositories\ChapterRepository;
use App\Repositories\ClassRepository;
use App\Repositories\QuestionRepository;
use App\Repositories\SubjectRepository;
use Inertia\Inertia;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    protected $questionRepository;

    protected $classRepository;

    protected $subjectRepository;

    protected $chapterRepository;

    public function __construct(
        QuestionRepository $questionRepository,
        ClassRepository $classRepository,
        SubjectRepository $subjectRepository,
        ChapterRepository $chapterRepository
    )
    {
        $this->questionRepository = $questionRepository;
        $this->chapterRepository = $chapterRepository;
        $this->subjectRepository = $subjectRepository;
        $this->classRepository = $classRepository;
    }

    public function index(Request $request)
    {
        $questionList = $this->questionRepository->list($request['size']);
        if ($request['search']) {
            $questionList = $this->questionRepository->search($request['search'], $request['size']);
        }

        return Inertia::render('Questions/Index', [
            'questionList' => $questionList,
            'chapters' => $this->chapterRepository->all(),
            'classes' => $this->classRepository->all(),
            'subjects' => $this->subjectRepository->all()
        ]);
    }

    public function create()
    {
        return Inertia::render('Questions/Create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'question' => 'required|string|max:255',
            'subject_id' => 'numeric|required',
            'class_id' => 'numeric|required',
            'chapter_id' => 'numeric|required',
            'mark' => 'numeric|required',
            'type' => 'string|nullable',
            'option' => 'array|nullable',
        ]);

        $this->questionRepository->create($data);

        return true;
    }

    public function show($id)
    {
        $question = $this->questionRepository->find($id);
        return Inertia::render('Questions/Show', ['question' => $question]);
    }

    public function edit($id)
    {
        $question = $this->questionRepository->find($id);
        return Inertia::render('Questions/Edit', ['question' => $question]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'question' => 'required|string|max:255',
            'subject_id' => 'numeric|required',
            'class_id' => 'numeric|required',
            'chapter_id' => 'numeric|required',
            'mark' => 'numeric|required',
            'type' => 'string|nullable',
            'option' => 'array|nullable',
        ]);

        $this->questionRepository->update($id, $data);

        return true;
    }

    public function destroy($id)
    {
        $this->questionRepository->delete($id);

        return true;
    }
}
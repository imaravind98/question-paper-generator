<?php

namespace App\Http\Controllers;

use App\Repositories\ChapterRepository;
use App\Repositories\ClassRepository;
use App\Repositories\QuestionRepository;
use App\Repositories\SubjectRepository;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ExportController extends Controller
{

    protected $classRepository;

    protected $subjectRepository;

    protected $chapterRepository;

    protected $questionRepository;

    public function __construct(
        ClassRepository $classRepository,
        SubjectRepository $subjectRepository,
        ChapterRepository $chapterRepository,
        QuestionRepository $questionRepository
    )
    {
        $this->classRepository = $classRepository;
        $this->subjectRepository = $subjectRepository;
        $this->chapterRepository = $chapterRepository;
        $this->questionRepository = $questionRepository;
    }
    public function index ()
    {
        return inertia('Export/Index',
            [
                'classes' => $this->classRepository->all(),
                'subjects' => $this->subjectRepository->all(),
                'chapters' => $this->chapterRepository->all(),
                'questions' => $this->questionRepository->all()
            ]
        );
    }

    public function export (Request $request)
    {
        $questions = $this->questionRepository->all($request['chapters']);
        $subject = $this->subjectRepository->find($request['subject']);
        $classes = $this->classRepository->find($request['classes']);

        $pdf = Pdf::loadView('export_question', [
            'data' => $request['questions'],
            'questions' => $questions->toArray(),
            'subject' => $subject->toArray(),
            'classes' => $classes->toArray(),
            'testName' => $request['testName'],
            'totalMark' => $request['totalMark'],
            'duration' => $request['duration']
        ]);

        return $pdf->download('question_paper.pdf');
    }
}

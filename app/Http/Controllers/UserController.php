<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Inertia\Inertia;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepository;

    /**
     * Constructor to bind repository to controller.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the Users.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $userList = $this->userRepository->list($request['size']);
        if ($request['search']) {
            $userList = $this->userRepository->search($request['search'], $request['size']);
        }
        return Inertia::render('Users/Index', ['userList' => $userList]);
    }

    /**
     * Show the form for creating a new User.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Users/Create');
    }

    /**
     * Store a newly created User in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users,email|string|max:255',
            'group' => "string|max:255",
            'password'=> 'required|string|max:255'
        ]);

        return $this->userRepository->create($data);
    }

    /**
     * Display the specified User.
     *
     * @param int $id
     * @return \Inertia\Response
     */
    public function show($id)
    {
        $User = $this->userRepository->find($id);
        return Inertia::render('Users/Show', ['UserData' => $User]);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param int $id
     * @return \Inertia\Response
     */
    public function edit($id)
    {
        $User = $this->userRepository->find($id);
        return Inertia::render('Users/Edit', ['UserData' => $User]);
    }

    /**
     * Update the specified User in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|unique:users,email,{$id}|string|max:255",
            'group' => "string|max:255",
            'password'=> 'required|string|max:255'
        ]);

        $this->userRepository->update($id, $data);

        return true;
    }

    /**
     * Remove the specified User from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->userRepository->delete($id);

        return true;
    }
}

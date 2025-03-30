<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\ResponseContract;
use App\Models\TaskList;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class TaskListController extends Controller
{
    public function __construct(public ResponseContract $json)
    {
        
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $user = Auth::user();
        $taskList = User::with('taskList')
            ->whereRelation('taskList', 'id', $user->id)
            ->get();
        
        return $this->json->response(data: [
            'taskLists' =>  $taskList[0]['tasklist']
            // 'facility:' => 'объекты!!!!',
            //'facilities' => ($taskList->sortByDesc('id')->values()->all()),
        ]);
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = Auth::user();
        $taskList = new TaskList($request->input('taskList'));
        
        // $taskListNew = TaskList::create(
        //     $taskList
        // );
        $user->taskList()->save($taskList);
        return $this->json->response(
            data: [
               
                'taskListNew' => $taskList,
            
            ],
            message: 'Список создан',
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\ResponseContract;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use function PHPUnit\Framework\isNull;

class TaskController extends Controller
{
    public function __construct(public ResponseContract $json)
    {
        
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = Auth::user();
        
        $taskNew = $request->input('task');

        $taskList = $user->taskList()->find($taskNew['list_id']);

        if (is_null($taskList)){
            return $this->json->error(
                message: 'Попытка добавить задачу в чужой список!',
                errors: 501
            ); 
        }
        $taskMaxNum = Task::where('list_id',$taskNew['list_id'])->max('sorting');
        $taskNew['sorting'] = $taskMaxNum + 1;
        $task = Task::create( $taskNew );
        
        // $task->tasklist()
        // $user->taskList()->save($taskList);
        return $this->json->response(
            data: [
                'taskNew' => $task,
            ],
            message: 'Задача добавлена.',
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

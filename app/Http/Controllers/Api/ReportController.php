<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\ResponseContract;

use App\Http\Resources\TaskListResource;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Models\TaskList;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use PhpParser\Node\Stmt\TryCatch;

class ReportController extends Controller
{
    public function __construct(public ResponseContract $json)
    {
        
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
       
    
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::user();
        $taskList = $user->taskList()->find($id);
                      
        if (is_null($taskList)){
            return $this->json->error(
                message: 'Попытка прочитать чужой список!',
                errors: 403
            ); 
        }

        $taskList['usersCount'] = count($taskList->users()->get());
        $taskList['usersList'] = $taskList->users()->get();

        $tasks = Task::where('list_id', $id)
            ->orderBy('sorting')
            ->get();
       
        return $this->json->response(
            data: [
                'taskList' => new TaskListResource($taskList),
                'tasks' => TaskResource::collection($tasks),
                
            ],
            message: 'Отчет.',
    );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id ): \Illuminate\Http\JsonResponse
    {
        
    }

    
    //удаление списков
    public function destroy(Request $request, $id): \Illuminate\Http\JsonResponse
    {   
       
   
    }
    
    
}

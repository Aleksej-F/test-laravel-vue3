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
        // $taskList = User::with('taskList')
        //     ->whereRelation('taskList', 'id', $user->id)
        //     ->get();
        
        $taskList = $user->taskList()->get();

        return $this->json->response(
            data: [
                'taskLists' =>  $taskList
            ],
            message: count($taskList) > 0 ? 'Списки задач.' : 'Списки задач не созданы.',
    );
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
        $taskList = TaskList::find($id);
        $taskList->tasks;
        return $this->json->response(data: [
            'taskList' => ($taskList),
            // 'slider' => ($facility->sliders)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id ): \Illuminate\Http\JsonResponse
    {
        $user = Auth::user();
        $taskListNew = $request->input('taskList');
        
        $taskList = TaskList::find($id);
        // $user->taskList()->save($taskList);
        
        $taskList->update($taskListNew); 
        // $user->taskList()->save($taskList); //обновление в связывающей таблице
        return $this->json->response(
            data: [
                'taskList' => $taskList,
            ],
            message: 'Список обновлен',
        );
    }

    /**
     * Remove the specified resource from storage.
     */  
    // 1|AuQPCTIoo55s7SMY94ib0wWttfezRcGl6t8lKRuf99566c0c
    // 2|96VuTDdIUIrfuArL2ksGqQ9h9RM4LEcRXIyhhqNj7d6948ba
    public function destroy(Request $request, $id): \Illuminate\Http\JsonResponse
    {   
        $user = Auth::user();
        $taskListDelete = $request->input('taskList');
        $message = '';
        $newListDelete = [];
        $taskListNew = [];
        if ($taskListDelete !== null && is_array($taskListDelete) && count($taskListDelete) !== 0) {
            
            foreach ($taskListDelete as $i => $value) {
                $taskListUserFind = $user->taskList()->find($taskListDelete[$i]);
                if (!is_null($taskListUserFind)){
                    array_push( $newListDelete, $taskListDelete[$i]);
                }
            }
           
            if (count($newListDelete) > 0){
                try {
                    TaskList::destroy($newListDelete);
                    $user->taskList()->detach($newListDelete);
                    $taskListNew = $user->taskList()->get();
                } catch (\Throwable $e) {
                    return $this->json->error(message: $e->getMessage());
                }
                $message = 'Списки удалены.';
            } else {
                 $message = 'Укажите, принадлежащие Вам, списки для удаления!';
            }
            
        } else {
            $message = 'Укажите списки для удаления!';
        }
        
        return $this->json->response(
            data: [
                'taskListDelete' => $taskListDelete,
                'newListDelete' => $newListDelete,
                'taskListNew'=> $taskListNew,
            ],
            message: $message,
        );
   
    }
}

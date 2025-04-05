<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\ResponseContract;

use App\Models\Task;
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

        foreach ($taskList as $i => $value) {
            $taskList[$i]['tasks'] = Task::where('list_id', $value['id'])
            ->orderBy('sorting')
            ->get();
        }
       
        return $this->json->response(
            data: [
                'taskLists' =>  $taskList
            ],
            message: count($taskList) > 0 ? 'Списки задач.' : 'Списки задач не созданы.',
    );
        //taskList.l7933yx2.beget.tech
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = Auth::user();
        $taskList = new TaskList($request->input('taskList'));
       
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
        $user = Auth::user();
        $taskList = $user->taskList()->find($id);

        if (is_null($taskList)){
            return $this->json->error(
                message: 'Попытка прочитать чужой список!',
                errors: 501
            ); 
        }
        $taskList = Task::where('list_id', $id)
            ->orderBy('sorting')
            ->get();
       
        return $this->json->response(
            data: [
                'taskList' => $taskList,
            ],
            message: 'Список задач.',
    );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id ): \Illuminate\Http\JsonResponse
    {
        $user = Auth::user();
        $taskListNew = $request->input('taskList');
        $taskListUserFind = $user->taskList()->find($id);
        if (is_null($taskListUserFind)){
            return $this->json->error(
                message: 'Укажите, принадлежащий Вам, список для редактирования!',
                errors: 501
            );
        };
        $taskList = TaskList::find($id);
        
        if (array_key_exists('id', $taskListNew) && !is_null($taskListNew['id']) && ($taskList->id !== $taskListNew['id'])){
            return $this->json->error(
                message: 'id списка не соответствует!',
                errors: 501
            );
        };
                
        try {
            $taskList->update($taskListNew);
        } catch (\Throwable $e) {
            return $this->json->error(
                message: $e->getMessage(),
                errors: 501
            );
        }

        // $user->taskList()->save($taskList); //обновление в связывающей таблице
        return $this->json->response(
            data: [
                'taskListNew' => $taskList
            ],
            message: 'Список обновлен',
        );
    }

    /**
     * Remove the specified resource from storage.
     */  
    // 1|AuQPCTIoo55s7SMY94ib0wWttfezRcGl6t8lKRuf99566c0c
    // 2|96VuTDdIUIrfuArL2ksGqQ9h9RM4LEcRXIyhhqNj7d6948ba
    
    //  http://testklass
    //  http://tasklist.l7933yx2.beget.tech


    //	1|17t6kJeNDeH6hB7PA0xfALcBK2nyvvCVRSmNrMNM9a011cb7
    //  5|zDwqN2Y7LLY1OfeAUuSgzlwTNvb6IAzWQAORaEEz79601cbe

    public function destroy(Request $request, $id): \Illuminate\Http\JsonResponse
    {   
        $user = Auth::user();
        $taskListDelete = $request->input('taskList');
        $message = '';
        $newListDelete = [];
        $taskListNew = [];
        
        if ($taskListDelete == null){
            $taskListUserFind = $user->taskList()->find($id);
            if (!is_null($taskListUserFind)){
                array_push( $newListDelete, $id);
            }
        } elseif (is_array($taskListDelete) && count($taskListDelete) !== 0) {
            
            foreach ($taskListDelete as $i => $value) {
                $taskListUserFind = $user->taskList()->find($taskListDelete[$i]);
                if (!is_null($taskListUserFind)){
                    array_push( $newListDelete, $taskListDelete[$i]);
                }
            }
           
        } else {
            return   $this->json->error(
                message: 'Укажите списки для удаления!',
                errors: 501
            );
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
            return   $this->json->error(
                message: 'Укажите, принадлежащие Вам, списки для удаления!',
                errors: 501
            );
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

    public function tasklistUpdate(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = Auth::user();
        $taskListDelete = $user->taskList()->get();
        $newListDelete = [];
        if (count($taskListDelete) > 0){
            foreach ($taskListDelete as $i => $value) {
                array_push( $newListDelete, $value->id);
                // $deleted = Task::where('list_id', $value->id)->delete();
            }
            try {
                TaskList::destroy($newListDelete);
                // $taskListDelete->delete();
                $user->taskList()->detach($newListDelete);
                // $taskListNew = $user->taskList()->get();
            } catch (\Throwable $e) {
                return $this->json->error(message: $e->getMessage(),
                data: [
                    'taskList' =>$newListDelete,
                ],
            
                );
            }
            $message = 'Списки удалены.';
        } 
        $taskListNew = $request->input('taskList');
        foreach ($taskListNew as $i => $value) {
            $taskList = TaskList::create([
               'text' => $value['text'],
            ]);
            $user->taskList()->save($taskList);
            foreach ($value['tasks']as $ii => $taskValue) {
                $task = new Task( $taskValue );
                $task->list_id = $taskList->id;
                $task->save();
            }
            
        }
        $taskListNew = $user->taskList()->get();

        foreach ($taskListNew as $i => $value) {
            $taskListNew[$i]['tasks'] = Task::where('list_id', $value['id'])
            ->orderBy('sorting')
            ->get();
        }
       
        return $this->json->response(
            data: [
                'taskList' =>$taskListNew,
            ],
            message:  'Списки обновлены.',
        );
    }
}

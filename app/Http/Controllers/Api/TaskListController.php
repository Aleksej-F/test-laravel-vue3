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
            $taskList[$i]['tasks'] = TaskResource::collection(Task::where('list_id', $value['id'])
            ->orderBy('sorting')
            ->get());
            // $taskList[$i]['users'] =  $value->users()->get();
            $taskList[$i]['usersCount'] = count($value->users()->get());
        }
        // 
       
        return $this->json->response(
            data: [
                'taskLists' => TaskListResource::collection($taskList) 
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
                errors: 403
            );
        };
        $taskList = TaskList::find($id);
        
        if (array_key_exists('id', $taskListNew) && !is_null($taskListNew['id']) && ($taskList->id !== $taskListNew['id'])){
            return $this->json->error(
                message: 'id списка не соответствует!',
                errors: 400
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
    //удаление списков
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
                errors: 400
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
            if (count($newListDelete) == 1){
                $message = 'Список удален.';
            } else {
                $message = 'Списки удалены.';
            }

        } else {
            return   $this->json->error(
                message: 'Укажите, принадлежащие Вам, списки для удаления!',
                errors: 403
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
    //синхронизация списков
    public function tasklistUpdate(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = Auth::user();
        //удаление старых списков
        try {
            $user->taskList()->delete();
            $message = 'Списки удалены.';
        } catch (\Throwable $e) {
            return $this->json->error(
                message: $e->getMessage(),
            );
        }
        
        //запись новых списков и задач
        $taskListUpdate = $request->input('taskList');
        $taskListSync = [];
        foreach ($taskListUpdate as $i => $value) {
            $taskList = TaskList::create([
               'text' => $value['text'],
            ]);
            array_push($taskListSync, $taskList->id);
            $n = 1;
            foreach ($value['tasks']as $ii => $taskValue) {
                $task = new Task( $taskValue );
                $task->list_id = $taskList->id;
                $task->sorting = $n;
                $n += 1;
                $task->save();
            }
        }
        // обновление записей в промежуточной таблице
        $user->taskList()->sync($taskListSync);
        $message = 'Списки обновлены.';
        
        // получение обновленных данных
        $taskListNew = $user->taskList()->get();

        foreach ($taskListNew as $i => $value) {
            $taskListNew[$i]['tasks'] = TaskResource::collection(Task::where('list_id', $value['id'])
            ->orderBy('sorting')
            ->get()
            );
        }
       
        return $this->json->response(
            data: [
                'taskList' =>$taskListNew,
            ],
            message: $message,
        );
    }

    public function tasklistShare (Request $request): \Illuminate\Http\JsonResponse
    {
        $taskListShare = $request->input('taskList');
        $userShare = $request->input('user');
        $user = Auth::user();
        $taskListUserFind = $user->taskList()->find($taskListShare['id']);
        if (!is_null($taskListUserFind)){
            $taskList = TaskList::find($taskListShare['id']);
            $taskList->users()->attach($userShare['id']);
        } else{
            return   $this->json->error(
                message: 'Укажите, принадлежащий Вам, список!',
                errors: 403
            ); 
        }

        return $this->json->response(
            data: [
                'taskList' => $taskListShare['id'],
                'userShare' => $userShare['id']
            ],
            message: "Вы поделись списком с пользователем - ",
        );


    }

    public function getTasklistShare (string $id): \Illuminate\Http\JsonResponse
    {
        $taskList = [];
        
        try {
           $taskList = TaskList::find($id);
           if (is_null($taskList) ){
                return $this->json->error(
                    message: 'Список не найден!',
                    errors: 403
                );
           } 
           $taskList->tasks()->get();
        } catch (\Throwable $e) {
            return $this->json->error(message: $e->getMessage());
        }
       
        return $this->json->response(
            data: [
                'taskList' => new TaskListResource($taskList),
                
            ],
            message: "Вы получили список по приглашению.",
        );
        // tasklistAppend
    }
    // добавление списка для совместного использования
    public function tasklistAppend (string $id): \Illuminate\Http\JsonResponse
    {
        $user = Auth::user();
        $taskList = $user->taskList()->find($id);
        if (is_null($taskList)){
            try {
            // обновление записей в промежуточной таблице
                $user->taskList()->attach([$id]);
            } catch (\Throwable $e) {
                return $this->json->error(message: $e->getMessage());
            }
        } else {
            return   $this->json->error(
                message: 'У Вас уже есть этот список!',
                errors: 403
            ); 
        }
        return $this->json->response(
            data: [
                'taskList' => [],
                '$taskList' => $taskList,
                
            ],
            message: "Список успешно добавлен.",
        );
        // tasklistAppend
    }
    
}

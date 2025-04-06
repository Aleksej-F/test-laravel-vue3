<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\ResponseContract;

use App\Http\Resources\TaskResource;
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
        return $this->json->response(
            data: [
                'task' => "task ",
            ],
            message: 'В разработке.',
        );
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
        $user = Auth::user();
        try {
            $task = Task::find($id);
            if (is_null( $task)){
                return   $this->json->error(
                    message: 'Попытка получить несуществующую задачу!',
                    errors: 501
                );
            }
            $taskListUserFind = $user->taskList()->find($task['list_id']);
            if (is_null($taskListUserFind)){
                return   $this->json->error(
                    message: 'Попытка получить несвою задачу!',
                    errors: 501
                );
            } 
        } catch (\Throwable $e) {
            return $this->json->error(
                message: $e->getMessage(),
                errors: 501
            );
        }



        return $this->json->response(
            data: [
                'task' => TaskResource::make($task),
            ],
            message: 'Задача найдена.',
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): \Illuminate\Http\JsonResponse
    {
        $user = Auth::user();
        $taskNew = $request->input('task');
        if (is_null($taskNew) || !is_array($taskNew)){
            return   $this->json->error(
                message: 'Укажите описание задачи для внесения изменений!',
                errors: 501
            );
        }
        if (array_key_exists('id', $taskNew)){
            $id =  $taskNew['id'];
        }
        try {
            $task = Task::find($id);
            if (is_null( $task)){
                return   $this->json->error(
                    message: 'Попытка изменить несуществующую задачу!',
                    errors: 501
                );
            }
            $taskListUserFind = $user->taskList()->find($task['list_id']);
            if (is_null($taskListUserFind)){
                return   $this->json->error(
                    message: 'Попытка изменить несвою задачу!',
                    errors: 501
                );
            } 
        } catch (\Throwable $e) {
            return $this->json->error(
                message: $e->getMessage(),
                errors: 501
            );
        }
        $sortBol =  $taskNew['sorting'] !== $task->sorting;
        try {
            $task->update($taskNew);
        } catch (\Throwable $e) {
            return $this->json->error(
                message: $e->getMessage(),
                errors: 501
            );
        }
        $tasks = [];
        if ($sortBol){
           
            $tasks = Task::where('list_id', $taskNew['list_id'])
            ->orderBy('sorting')
            ->orderByDesc('updated_at')
            ->get();
            
            foreach ($tasks as $i => $taskValue) {
                $taskValue->sorting =  $i+1;
                $taskValue->update();
            }
        }

       
        return $this->json->response(
            data: [
                'taskNew' => $task,
                'tasks' =>  $tasks
            ],
            message: 'В разработке.'//'Задача обновлена',
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $user = Auth::user();
        
        $tasksDelete = $request->input('tasks');
        $taskListUserFind = '';
        $message = '';
        $newtasksDelete = [];
        $tasksNew = [];
        $task = null;
        //если нет массива задач, проверяем значение адресной строки
        if (is_null($tasksDelete)){
            try {
                $task = Task::find($id);
                if (is_null( $task)){
                    return   $this->json->error(
                        message: 'Попытка удалить несуществующую задачу!',
                        errors: 501
                    );
                }
                $taskListUserFind = $user->taskList()->find($task['list_id']);
            } catch (\Throwable $e) {
                return $this->json->error(
                    message: $e->getMessage(),
                    errors: 501
                );
            }
            if (!is_null($taskListUserFind)){
                array_push( $newtasksDelete, $id);
            } 
        } elseif (!is_null($tasksDelete) && is_array($tasksDelete) && count($tasksDelete) !== 0) {
            
            foreach ($tasksDelete as $i => $value) {
                try {
                    $task = Task::find($tasksDelete[$i]);
                    if (!is_null($task)){
                        $taskListUserFind = $user->taskList()->find($task['list_id']);
                        if (!is_null($taskListUserFind)){
                            array_push($newtasksDelete, $tasksDelete[$i]);
                        }
                    }
                 } catch (\Throwable $e) {
                    return $this->json->error(
                        message: $e->getMessage(),
                        errors: 501
                    );
                }
            }
           
        } else {
            return   $this->json->error(
                message: 'Укажите задачи для удаления!',
                errors: 501
            );
        }
        
        if (count($newtasksDelete) > 0){
            try {
                Task::destroy($newtasksDelete);
            } catch (\Throwable $e) {
                return $this->json->error(message: $e->getMessage());
            }
            $message = 'Задачи удалены.';
        } else {
            return   $this->json->error(
                message: 'Укажите, принадлежащие Вам, задачи для удаления!',
                errors: 501
            );
        }
       
        return $this->json->response(
            data: [
                // 'task' => $task,
                // 'taskList' => $taskListUserFind,
                'newtasksDelete' => $newtasksDelete,
                'tasksDelete' => $tasksDelete,
            ],
            message: $message//'Задача обновлена',
        );
    }
}

<?php

namespace Modules\Tasks\Repositories;

use Modules\Tasks\Entities\Task;
use Modules\Tasks\Entities\TasksComment;
use Modules\Tasks\Events\TaskCommentAdded;
use Modules\Tasks\Interfaces\TasksCommentRepository;
use Modules\Tasks\Presenters\TasksCommentPresenter;
use Modules\Tasks\Traits\Historyable;
use Modules\Tasks\Validators\TasksCommentValidator;
use Panoscape\History\Events\ModelChanged;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class TasksCommentRepositoryEloquent.
 */
class TasksCommentRepositoryEloquent extends BaseRepository implements TasksCommentRepository
{
    use Historyable;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TasksComment::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {
        return TasksCommentValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return TasksCommentPresenter::class;
    }

    public function addCommentHistory(TasksComment $comment, Task $task, $fireNotification = true)
    {
        $oldComment = []; // no old value
        // get new assignedUsers ids after attach new value
        $newComment = [$comment->id];
        $createdComment = $this->getChangedRelationAsObject($oldComment, $newComment, 'comments');
        //fire a model changed event
        event(new ModelChanged($task, 'task_comment_created', $createdComment));
        $notified_users = $task->assignedUsers->pluck('id')->toArray(); // must be array

        // for Reserve , we will get every thing in histories
        broadcast(new TaskCommentAdded($task->unsetRelations(), $notified_users, '', '', $fireNotification));
    }
}

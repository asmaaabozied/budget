<?php

namespace Modules\Tasks\Traits;

use App\User;
use Modules\Tasks\Entities\TasksComment;
use Modules\Tasks\Entities\TasksStatuse;

trait Historyable
{
    public function formattedHistories()
    {
        $formattedHistory = [];

        if (isset($this->histories)) {
            foreach ($this->histories as $history) {
                $f_history = [
                    'user' => $history->hasUser() ? $history->user() : '',
                    'message' => trans('tasks::model_history.task.'.$history->message), // get translated process ex, created, updated .etc
                    'meta' => $history->meta,
                    'performed_at' => $history->performed_at->format('Y.m.d H:i:s'),
                ];

                // not needed , we will extract in front app
//                if (isset($history['meta']) && !is_array($history['meta']) && is_string($history['meta'])) {
//                    $historyMeta = json_encode(json_decode($history['meta'], true));
//
//                    foreach ($historyMeta as $meta) {
//
//                        if (!is_array($meta) && is_string($meta)) {
//                            $meta = json_encode(json_decode($meta, true));
//                        }
//
//                        if ($meta['key'] == 'assignedUsers') {
//                            $f_history['meta'][] = [
//                                'key' => $meta['key'],
//                                'old' => $this->getUser($meta['old']),
//                                'new' => $this->getUser($meta['new']),
//                            ];
//                        } elseif ($meta['key'] == 'status_id') {
//                            $f_history['meta'][] = [
//                                'key' => $meta['key'],
//                                'old' => $this->getStatus($meta['old']),
//                                'new' => $this->getStatus($meta['new']),
//                            ];
//                        } elseif ($meta['key'] == 'comments') {
//                            $f_history['meta'][] = [
//                                'key' => $meta['key'],
//                                'old' => $this->getComment($meta['old']),
//                                'new' => $this->getComment($meta['new']),
//                            ];
//                        } else {
//                            $f_history['meta'][] = [
//                                'key' => $meta['key'],
//                                'old' => $meta['old'],
//                                'new' => $meta['new'],
//                            ];
//                        }
//                    }
//                }

                array_push($formattedHistory, $f_history);
            }
        }

        return $formattedHistory;
    }

    public function getUser($user)
    {
//        return User::whereIn('id',$user)->select('id','name','father_name','family_name');
        return User::where('id', $user)->get();
    }

    public function getStatus($statuseId)
    {
        return TasksStatuse::where('id', $statuseId)->get();
    }

    public function getComment($commentId)
    {
        return TasksComment::where('id', $commentId)->get();
    }

    // custom function to make custom object format for changed relations ,, needed when add  changed relation ships to DB
    public function getChangedRelationAsObject($oldVal, $newVal, $key = 'assignedUsers')
    {
        $newObbject = new \stdClass();
        $newObbject->key = $key;
        $newObbject->old = (object) $oldVal;
        $newObbject->new = (object) $newVal;

        return json_decode(json_encode([$newObbject]), true); // the bracket to return data like [{ , this is true format
    }
}

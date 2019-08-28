<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Action
 *
 * @property int $id
 * @property int $deployment_id
 * @property int $task_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $status
 * @property string|null $message
 * @property string|null $log
 * @property-read \App\Deployment $deployment
 * @property-read \App\Task $task
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Action newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Action newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Action query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Action whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Action whereDeploymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Action whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Action whereLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Action whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Action whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Action whereTaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Action whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Action extends Model {

    protected $fillable = [];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    /**
     * @return BelongsTo|Deployment
     */
    public function deployment()
    {
        return $this->belongsTo(Deployment::class, 'deployment_id');
    }

    /**
     * @return BelongsTo|Task
     */
    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

}

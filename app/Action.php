<?php namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Action
 *
 * @property int $id
 * @property int $deployment_id
 * @property int $task_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $status
 * @property string|null $message
 * @property string|null $log
 * @property-read Deployment $deployment
 * @property-read Task $task
 * @method static Builder|Action newModelQuery()
 * @method static Builder|Action newQuery()
 * @method static Builder|Action query()
 * @method static Builder|Action whereCreatedAt($value)
 * @method static Builder|Action whereDeploymentId($value)
 * @method static Builder|Action whereId($value)
 * @method static Builder|Action whereLog($value)
 * @method static Builder|Action whereMessage($value)
 * @method static Builder|Action whereStatus($value)
 * @method static Builder|Action whereTaskId($value)
 * @method static Builder|Action whereUpdatedAt($value)
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

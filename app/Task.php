<?php namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Task
 *
 * @property int $id
 * @property int $project_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property string $script
 * @property int $order
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Action[] $actions
 * @property-read \App\Project $project
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task whereScript($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Task extends Model {

    protected $fillable = [];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    /**
     * @return BelongsTo|Project
     */
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    /**
     * @return HasMany|Collection|Action
     */
    public function actions()
    {
        return $this->hasMany(Action::class, 'task_id');
    }

    /**
     * Api Path
     * @return string
     */
    public function apiPath(): string {
        return route('task.view', ['task' => $this->id]);
    }
}

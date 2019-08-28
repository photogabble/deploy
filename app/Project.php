<?php namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Project
 *
 * @property int $id
 * @property string $uuid
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property string $provider
 * @property string $repository
 * @property string $main_branch
 * @property string|null $heartbeat_url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Deployment[] $deployments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Environment[] $environments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Server[] $servers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Task[] $tasks
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereHeartbeatUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereMainBranch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereRepository($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereUuid($value)
 * @mixin \Eloquent
 */
class Project extends Model
{

    use HasUUID;

    const PROVIDER_GITHUB = 'github';
    const PROVIDER_GITLAB = 'gitlab';
    const PROVIDER_UNSUPPORTED = 'unsupported';

    protected $fillable = [];

    public static $rules = [
        // Validation rules
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function (Project $model) {
           if (empty($model->provider)) {
               if (strpos($model->repository, 'github.com') !== false) {
                   $model->provider = static::PROVIDER_GITHUB;
               } else if (strpos($model->repository, 'gitlab.com') !== false) {
                   $model->provider = static::PROVIDER_GITLAB;
               } else {
                   $model->provider = static::PROVIDER_UNSUPPORTED;
               }
           }
        });
    }

    /**
     * @return BelongsTo|User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return HasMany|Collection|Server[]
     */
    public function servers()
    {
        return $this->hasMany(Server::class, 'project_id');
    }

    /**
     * @return HasMany|Collection|Deployment[]
     */
    public function deployments()
    {
        return $this->hasMany(Deployment::class, 'project_id');
    }

    /**
     * @return HasMany|Collection|Environment[]|Environment
     */
    public function environments()
    {
        return $this->hasMany(Environment::class, 'project_id');
    }

    /**
     * @return HasMany|Collection|Task[]
     */
    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id');
    }

    /**
     * Api Path
     * @return string
     */
    public function apiPath(): string {
        return route('project.view', ['project' => $this->id]);
    }

    /**
     * WebHook path for triggering deployments
     * @return string
     */
    public function webHookPath(): string {
        return route('project.deploy', ['project' => $this->uuid]);
    }

}

<?php namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Project
 *
 * @property-read Collection|Deployment[] $deployments
 * @property-read Collection|Server[] $servers
 * @property-read Collection|Task[] $tasks
 * @property-read User $user
 * @method static Builder|Project newModelQuery()
 * @method static Builder|Project newQuery()
 * @method static Builder|Project query()
 * @property int $id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $name
 * @property string $provider
 * @property string $repository
 * @property string $branch
 * @property string|null $heartbeat_url
 * @method static Builder|Project whereBranch($value)
 * @method static Builder|Project whereCreatedAt($value)
 * @method static Builder|Project whereHeartbeatUrl($value)
 * @method static Builder|Project whereId($value)
 * @method static Builder|Project whereName($value)
 * @method static Builder|Project whereProvider($value)
 * @method static Builder|Project whereRepository($value)
 * @method static Builder|Project whereUpdatedAt($value)
 * @method static Builder|Project whereUserId($value)
 * @property string $uuid
 * @method static Builder|Project whereUuid($value)
 */
class Project extends Model
{

    const PROVIDER_GITHUB = 'github';
    const PROVIDER_GITLAB = 'gitlab';

    protected $fillable = [];

    public static $rules = [
        // Validation rules
    ];

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
     * @return HasMany|Collection|Task[]
     */
    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id');
    }
}

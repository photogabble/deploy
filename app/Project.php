<?php namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

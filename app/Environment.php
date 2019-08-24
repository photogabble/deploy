<?php namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Environment
 *
 * @property int $id
 * @property int $project_id
 * @property int|null $server_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $branch
 * @property string $url
 * @property-read Collection|Deployment[] $deployments
 * @property-read Project $project
 * @property-read Server|null $server
 * @method static Builder|Environment newModelQuery()
 * @method static Builder|Environment newQuery()
 * @method static Builder|Environment query()
 * @method static Builder|Environment whereBranch($value)
 * @method static Builder|Environment whereCreatedAt($value)
 * @method static Builder|Environment whereId($value)
 * @method static Builder|Environment whereProjectId($value)
 * @method static Builder|Environment whereServerId($value)
 * @method static Builder|Environment whereUpdatedAt($value)
 * @method static Builder|Environment whereUrl($value)
 */
class Environment extends Model
{

    protected $fillable = [];

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
     * @return BelongsTo|Server
     */
    public function server()
    {
        return $this->belongsTo(Server::class, 'server_id');
    }

    /**
     * @return HasMany|Collection|Deployment[]
     */
    public function deployments()
    {
        return $this->hasMany(Deployment::class, 'environment_id');
    }
}

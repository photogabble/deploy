<?php namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Environment
 *
 * @property int $id
 * @property int $project_id
 * @property int|null $server_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $branch
 * @property string $url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Deployment[] $deployments
 * @property-read \App\Project $project
 * @property-read \App\Server|null $server
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Environment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Environment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Environment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Environment whereBranch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Environment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Environment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Environment whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Environment whereServerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Environment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Environment whereUrl($value)
 * @mixin \Eloquent
 */
class Environment extends Model
{

    protected $fillable = ['branch', 'url'];

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

    /**
     * Api Path
     * @return string
     */
    public function apiPath(): string {
        return route('environment.view', ['environment' => $this->id]);
    }
}

<?php namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Server
 *
 * @property int $id
 * @property int $project_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $last_connected
 * @property string $name
 * @property string $host
 * @property string $username
 * @property string $private_key
 * @property string $public_key
 * @property string $project_path
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Deployment[] $deployments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Environment[] $environments
 * @property-read \App\Project $project
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Server newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Server newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Server query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Server whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Server whereHost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Server whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Server whereLastConnected($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Server whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Server wherePrivateKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Server whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Server whereProjectPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Server wherePublicKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Server whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Server whereUsername($value)
 * @mixin \Eloquent
 */
class Server extends Model
{

    protected $fillable = [
        'name', 'host', 'username', 'private_key', 'public_key', 'project_path'
    ];

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
     * @return HasMany|Collection|Deployment[]
     */
    public function deployments()
    {
        return $this->hasMany(Deployment::class, 'server_id');
    }

    /**
     * @return HasMany|Collection|Environment[]
     */
    public function environments()
    {
        return $this->hasMany(Environment::class, 'server_id');
    }

    /**
     * Api Path
     * @return string
     */
    public function apiPath(): string {
        return route('server.view', ['server' => $this->id]);
    }
}

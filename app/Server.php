<?php namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Server
 *
 * @property int $id
 * @property int $project_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $last_connected
 * @property string $name
 * @property string $host
 * @property string $username
 * @property string $private_key
 * @property string $public_key
 * @property string $project_path
 * @property-read Collection|Deployment[] $deployments
 * @property-read Project $project
 * @method static Builder|Server newModelQuery()
 * @method static Builder|Server newQuery()
 * @method static Builder|Server query()
 * @method static Builder|Server whereCreatedAt($value)
 * @method static Builder|Server whereHost($value)
 * @method static Builder|Server whereId($value)
 * @method static Builder|Server whereLastConnected($value)
 * @method static Builder|Server whereName($value)
 * @method static Builder|Server wherePrivateKey($value)
 * @method static Builder|Server whereProjectId($value)
 * @method static Builder|Server whereProjectPath($value)
 * @method static Builder|Server wherePublicKey($value)
 * @method static Builder|Server whereUpdatedAt($value)
 * @method static Builder|Server whereUsername($value)
 */
class Server extends Model
{

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
     * @return HasMany|Collection|Deployment[]
     */
    public function deployments()
    {
        return $this->hasMany(Deployment::class, 'server_id');
    }
}

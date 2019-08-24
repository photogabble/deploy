<?php namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Deployment
 *
 * @property int $id
 * @property int $project_id
 * @property int $server_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Project $project
 * @method static Builder|Deployment newModelQuery()
 * @method static Builder|Deployment newQuery()
 * @method static Builder|Deployment query()
 * @method static Builder|Deployment whereCreatedAt($value)
 * @method static Builder|Deployment whereId($value)
 * @method static Builder|Deployment whereProjectId($value)
 * @method static Builder|Deployment whereServerId($value)
 * @method static Builder|Deployment whereUpdatedAt($value)
 */
class Deployment extends Model
{

    protected $fillable = [];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

//    /**
//     * @return BelongsTo|Project
//     */
//    public function project()
//    {
//        return $this->belongsTo(Project::class, 'project_id');
//    }
//
//    /**
//     * @return BelongsTo|Server
//     */
//    public function server()
//    {
//        return $this->belongsTo(Server::class, 'server_id');
//    }
}

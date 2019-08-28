<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Deployment
 *
 * @property int $id
 * @property int $environment_id
 * @property int $project_id
 * @property string $deploy_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deployment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deployment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deployment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deployment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deployment whereDeployType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deployment whereEnvironmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deployment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deployment whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deployment whereUpdatedAt($value)
 * @property string $delivery_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deployment whereDeliveryId($value)
 * @property-read \App\Environment $environment
 * @property-read \App\Project $project
 * @mixin \Eloquent
 */
class Deployment extends Model
{

    const DEPLOY_MANUAL = 'manual';
    const DEPLOY_AUTO   = 'auto';

    protected $fillable = ['deploy_type', 'delivery_id'];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function environment()
    {
        return $this->belongsTo(Environment::class, 'environment_id');
    }
}

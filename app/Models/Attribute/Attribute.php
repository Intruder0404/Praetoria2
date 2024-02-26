<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Attribute;

use App\Models\DataType;
use App\Models\User\UserAttributeValue;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

/**
 * Class Attribute
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property boolean $isActive
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Attribute extends Model
{
	protected $table = 'attributes';

	protected $fillable = [
        'id',
		'name',
        'isActive'
	];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'isActive' => 'boolean',
    ];

    /*public function type() : hasOneThrough
    {
        return $this->hasOneThrough(DataType::class,UserAttributeValue::class,'type_id',null,'id');
    }*/
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Kingdom;

use App\Models\Kingdom\KingdomAttributeValue;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Kingdom
 *
 * @property int $id
 * @property string $name
 * @property boolean $isActive
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Kingdom extends Model
{
	protected $table = 'kingdoms';

	protected $fillable = [
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

    public function attributeValues()
    {
        return $this->hasMany(KingdomAttributeValue::class,'kingdom_id');
    }
}
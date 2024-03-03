<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Guild;

use App\Models\Kingdom\Kingdom;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Guild
 *
 * @property int $id
 * @property string $name
 * @property boolean $isActive
 * @property string $description
 * @property string $kingdom_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Guild extends Model
{
    use HasFactory;

	protected $fillable = [
		'name',
        'isActive',
        'description',
        'kingdom_id'
	];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'isActive' => 'boolean',
    ];
    public function kingdom(): HasOne
    {
        return $this->hasOne(Kingdom::class,'id','kingdom_id');
    }
}

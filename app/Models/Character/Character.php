<?php

namespace App\Models\Character;

use App\Models\Family\Family;
use App\Models\Guild\Guild;
use App\Models\Religion\Religion;
use App\Models\User\Rank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Character
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 *
 * @package App\Models
 */
class Character extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'isActive',
        'rank_id',
        'religion_id',
        'family_id',
        'guild_id',
    ];

    protected $hidden = [
    ];

    protected $casts = [
        'isActive' => 'boolean',
    ];
    public function rank(): HasOne
    {
        return $this->hasOne(Rank::class,'id','rank_id');
    }
    public function religion(): HasOne
    {
        return $this->hasOne(Religion::class,'id','religion_id');
    }
    public function family(): HasOne
    {
        return $this->hasOne(Family::class,'id','family_id');
    }
    public function guild(): HasOne
    {
        return $this->hasOne(Guild::class,'id','guild_id');
    }
}

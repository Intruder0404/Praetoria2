<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Family;

use App\Models\User\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Family
 *
 * @property int $id
 * @property string $name
 * @property boolean $isActive
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Family extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'isActive',
        'user_id'
    ];

    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'isActive' => 'boolean',
    ];

    public function paterFamilia(): HasOne
    {
        return $this->HasOne(User::class,'id','user_id');
    }

}

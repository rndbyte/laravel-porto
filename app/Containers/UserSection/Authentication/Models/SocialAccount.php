<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Authentication\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use App\Containers\UserSection\Users\Models\User;
use App\Ship\Abstracts\Models\Model as AbstractModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SocialAccount
 * @package App\Containers\Authentication\Models
 * @property int id
 * @property int provider_id
 * @property string nickname
 * @property string avatar
 * @property string token
 * @property Carbon token_expires_at
 * @property string refresh_token
 * @property User|Builder|BelongsTo user
 * @property Carbon created_at
 * @property Carbon updated_at
 * @mixin Builder
 */
class SocialAccount extends AbstractModel
{
    use HasFactory;

    protected $table = 'social_accounts';
    protected $fillable = [
        'provider_id',
        'nickname',
        'avatar',
        'token',
        'token_expires_at',
        'refresh_token',
        'user_id',
    ];
    protected $guarded = [];
    protected $hidden = [
        'id',
        'user_id',
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'provider_id'   => 'int',
        'avatar'        => 'string',
        'token'         => 'string',
        'refresh_token' => 'string',
    ];
    protected $dates = [
        'token_expires_at',
        'created_at',
        'updated_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

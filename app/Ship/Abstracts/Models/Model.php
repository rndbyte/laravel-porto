<?php

declare(strict_types=1);

namespace App\Ship\Abstracts\Models;

use App\Ship\Contracts\OrmModel;
use Illuminate\Database\Eloquent\Model as BaseModel;

abstract class Model extends BaseModel implements OrmModel
{
}

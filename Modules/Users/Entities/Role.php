<?php

namespace Modules\Users\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Role extends Model
{

    protected $fillable = ['name'];

}

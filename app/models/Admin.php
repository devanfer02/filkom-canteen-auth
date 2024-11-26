<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Admin extends Model
{
    protected $table = 'admins';

    protected $primaryKey = 'admin_id';

    protected $fillable = ['email', 'password'];

    public function role(): BelongsTo 
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }
}

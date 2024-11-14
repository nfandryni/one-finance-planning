<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class superadmin extends Model
{
    use HasFactory;
    protected $table = 'super_admin';
    protected $primaryKey = 'id_superadmin';
    protected $fillable =['user_id','nama','email', 'jabatan', 'foto_profil'];
    public $timestamps = false;
 // One to Many

}

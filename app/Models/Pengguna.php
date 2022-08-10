<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengguna extends Model
{
    use SoftDeletes;

    protected $table = "pengguna";
    protected $fillable = [
        "nama_lengkap",
        "alamat",
        "gender",
        "telephone",
        "email",
        "password"
    ];

    protected $dates = ['deleted_at'];

    protected $hidden = [
        "password", "created_at", "updated_at", 'deleted_at'
    ];
}

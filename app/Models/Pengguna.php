<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    protected $table = "pengguna";
    protected $fillable = [
        "nama_lengkap",
        "alamat",
        "gender",
        "telephone",
        "email",
        "password"
    ];

    protected $hidden = [
        "password", "created_at", "updated_at"
    ];
}

<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cuci extends Model
{
    
    use SoftDeletes;

    protected $table = "barang";
    protected $primaryKey = "id_jenis_cuci";

    protected $fillable = [
        "nama_jenis_cuci"
    ];

    protected $dates = ['deleted_at'];
    protected $hidden = ['deleted_at','created_at','updated_at'];
}

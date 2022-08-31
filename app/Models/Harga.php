<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Harga extends Model
{
    
    use SoftDeletes;

    protected $table = "hargalaundry";
    protected $primaryKey = "id_harga_laundry";

    protected $fillable = [
        "harga",
        "id_barang",
        "id_jenis_cuci"
    ];

    protected $dates = ['deleted_at'];
    protected $hidden = ['deleted_at','created_at','updated_at'];
}

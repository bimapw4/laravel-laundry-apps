<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barang extends Model
{
    
    use SoftDeletes;

    protected $table = "barang";
    protected $primaryKey = "id_barang";

    protected $fillable = [
        "nama_barang",
        "id_kategori"
    ];

    protected $dates = ['deleted_at'];
    protected $hidden = ['deleted_at','created_at','updated_at'];
}

<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Layanan extends Model
{
    
    use SoftDeletes;

    protected $table = "layanan";
    protected $primaryKey = "id_layanan";

    protected $fillable = [
        "nama_layanan",
        "biaya"
    ];

    protected $dates = ['deleted_at'];
    protected $hidden = ['deleted_at','created_at','updated_at'];
}

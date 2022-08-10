<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    
    use SoftDeletes;
    
    protected $fillable = [
        "nama_kategori"
    ];
    protected $dates = ['deleted_at'];
    protected $hidden = ['deleted_at','created_at','updated_at'];
}

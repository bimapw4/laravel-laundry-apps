<?php
namespace App\Http\Controllers\Barang;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Services\Validator\ValidatorManager;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $barang = Barang::query();

        $barang->paginate();
    }

    public function create(Request $request)
    {
        try {
            (new ValidatorManager)->validateJSON($request, self::rule($request));

            return Barang::create([
                "nama_barang" => $request->nama_barang,
                "id_kategori" => $request->id_kategori
            ]);

        } catch (\ValidationException $th) {
        }
    }

    public function update(Request $request)
    {
         try {
            (new ValidatorManager)->validateJSON($request, self::rule($request));

            return Barang::where("id_barang", $request->id_barang)->update([
                "nama_barang" => $request->nama_barang,
                "id_kategori" => $request->id_kategori
            ]);

        } catch (\ValidationException $th) {
        }
    }

    public function delete($id)
    {
        return Barang::where("id_barang", $id)->delete();
    }

    public static function rule($request)
    {
        $validate =  [
            "nama_barang" => "required",
            "id_kategori" => "required|exist:kategori,id"
        ];

        if ($request->isMethod("put")) {
            $validate["id_barang"] = "required|exist:barang,id_barang";
        }

        return $validate;
    }
}

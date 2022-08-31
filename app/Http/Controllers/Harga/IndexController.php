<?php
namespace App\Http\Controllers\harga;

use App\Http\Controllers\Controller;
use App\Models\Harga;
use App\Services\Validator\ValidatorManager;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $data = Harga::query();

        $data->paginate();
    }

    public function create(Request $request)
    {
        try {
            (new ValidatorManager)->validateJSON($request, self::rule($request));

            return Harga::create([
                "harga" => $request->harga,
                "id_barang" => $request->id_barang,
                "id_jenis_cuci" => $request->id_jenis_cuci
            ]);

        } catch (\ValidationException $th) {
        }
    }

    public function update(Request $request)
    {
        try {
            (new ValidatorManager)->validateJSON($request, self::rule($request));

            return Harga::where("id_harga_laundry", $request->id_harga_laundry)->update([
                "harga" => $request->harga,
                "id_barang" => $request->id_barang,
                "id_jenis_cuci" => $request->id_jenis_cuci
            ]);

        } catch (\ValidationException $th) {
        }
    }

    public function delete($id)
    {
        return Harga::where("id_harga_laundry", $id)->delete();
    }

    public static function rule($request)
    {
        $validate = [
            "harga" => "required",
            "id_barang" => "required|exist:barang,id_barang",
            "id_jenis_cuci" => "required|exist:cuci,id_jenis_cuci"
        ];

        if ($request->isMethod("put")) {
            $validate["id_harga_laundry"] = "required|exist:harga,id_harga_laundry";
        }

        return $validate;
    }
}

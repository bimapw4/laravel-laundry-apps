<?php
namespace App\Http\Controllers\Layanan;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Services\Validator\ValidatorManager;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $layanan = Layanan::query();

        $layanan->paginate();
    }

    public function create(Request $request)
    {
        try {
            (new ValidatorManager)->validateJSON($request, self::rule($request));

            Layanan::create([
                "nama_layanan" => $request->nama_layanan,
                "biaya" => $request->biaya
            ]);

        } catch (\ValidationException $th) {
        }
    }

    public function update(Request $request)
    {
        try {
            (new ValidatorManager)->validateJSON($request, self::rule($request));

            Layanan::where("id_layanan", $request->id_layanan)->update([
                "nama_layanan" => $request->nama_layanan,
                "biaya" => $request->biaya
            ]);

        } catch (\ValidationException $th) {
        }
    }

    public function delete($id)
    {
        return Layanan::where("id_layanan", $id)->delete();
    }

    public static function rule($request)
    {
        $validate = [
            "nama_layanan" => "required",
            "biaya" => "required"
        ];

        if ($request->isMethod("put")) {
            $validate["id_layanan"] = "required|exist:layanan,id_layanan";
        }

        return $validate;
    }
}

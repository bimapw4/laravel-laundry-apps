<?php
namespace App\Http\Controllers\Cuci;

use App\Http\Controllers\Controller;
use App\Models\Cuci;
use App\Services\Validator\ValidatorManager;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $data = Cuci::query();

        $data->paginate();
    }

    public function create(Request $request)
    {
        try {
            (new ValidatorManager)->validateJSON($request, self::rule($request));

            return Cuci::create([
                "nama_jenis_cuci" => $request->nama_cuci,
            ]);

        } catch (\ValidationException $th) {
        }
    }

    public function update(Request $request)
    {
        try {
            (new ValidatorManager)->validateJSON($request, self::rule($request));

            return Cuci::where("id_jenis_cuci")->update([
                "nama_jenis_cuci" => $request->nama_jenis_cuci,
            ]);

        } catch (\ValidationException $th) {
        }
    }

    public function delete($id)
    {
        return Cuci::where("id_jenis_cuci", $id)->delete();
    }

    public static function rule($request)
    {
        $validate = [
            "nama_jenis_cuci" => "required"
        ];

        if ($request->isMethod('put')) {
            $validate["id_jenis_cuci"] = "required|exist:cuci,id_jenis_cuci";
        }

        return $validate;
    }
}

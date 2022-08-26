<?php
namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Services\Validator\ValidatorManager;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function Index(Request $request)
    {
        return Kategori::paginate();
    }    

    public function Create(Request $request)
    {
        try {
            (new ValidatorManager)->validateJSON($request, self::rule($request));

            return Kategori::Create([
                "nama_kategori" => $request->kategori
            ]);

        } catch (\UnauthorizedException $th) {
        }
    }

    public function Update(Request $request)
    {
        try {
            $validate = new ValidatorManager;
            $validate->validateJSON($request, self::rule($request));
            $validate->ValidateNotExist(new Kategori(), $request->id);
            
            return Kategori::where("id", $request->id)->update([
                "nama_kategori" => $request->kategori
            ]);

        } catch (\UnauthorizedException $th) {
        } catch (\ValidateException $th){
        }

    }

    public function Delete($id)
    {
        try {
            (new ValidatorManager)->ValidateNotExist(new Kategori(), $id);

            return Kategori::where('id', $id)->delete();
            
        } catch (\UnauthorizedException $th) {
        }
    }

    public static function rule($request)
    {
        $validate = [
            "nama_kategori" => "required"
        ];

        if ($request->isMethod('put')) {
            $validate['id'] = "required";
        }

        return $validate;
    }
}

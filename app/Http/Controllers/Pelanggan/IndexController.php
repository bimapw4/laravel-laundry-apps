<?php
namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use App\Services\Validator\ValidatorManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $user = Pengguna::query();

        if ($request->query("email")) {
            $user->where("email", $request->query("email"));
        }

        if ($request->query("nama_lengkap")) {
            $user->where("nama_lengkap", "like", "%".$request->query("nama_lengkap")."%");
        }

        return $user->paginate();
    }

    public function create(Request $request)
    {
        try {
            (new ValidatorManager)->validateJSON($request, self::ruleCreateUser());
            
            return Pengguna::create([
                "nama_lengkap" => $request->nama_lengkap,
                "alamat" => $request->alamat,
                "gender" => $request->gender,
                "telephone" => $request->telephone,
                "email" => $request->email,
                "password" => Hash::make($request->password)
            ]);

        } catch (\ValidateException $th) {
        }
    }

    public function update(Request $request)
    {
        try {
            (new ValidatorManager)->validateJSON($request, self::ruleUpdateUser($request));
            
            return Pengguna::where("id_pengguna", $request->userdata->id_pengguna)->update([
                "nama_lengkap" => $request->nama_lengkap,
                "alamat" => $request->alamat,
                "gender" => $request->gender,
                "telephone" => $request->telephone,
                "email" => $request->email
            ]);

        } catch (\ValidateException $th) {
        }
    }

    public function delete(Request $request,$id)
    {
        try {
            $pengguna = new Pengguna();

            $request->request->add(["id" => $id]);

            (new ValidatorManager)->validateJSON($request, self::ruleDeleteUser($request));

            return $pengguna::where('id_pengguna', $id)->delete();
        
        } catch (\UnauthorizedException $th) {
        }
       
    }

    public static function ruleCreateUser()
    {
        return [
            "nama_lengkap" => "required",
            "alamat" => "nullable",
            "gender" => "required",
            "telephone" => "required",
            "email" => "required|email|unique:pengguna,email",
            "password" => "required"
        ];
    }

    public function ruleUpdateUser($request)
    {
        return [
            "nama_lengkap" => "required",
            "alamat" => "nullable",
            "gender" => "required",
            "telephone" => "required",
            "email" => "required|email|unique:pengguna,email,".$request->userdata->id_pengguna.",id_pengguna"
        ];
    }

    public function ruleDeleteUser($id)
    {
        return [
            "id" => "exists:pengguna,id_pengguna"
        ];
    }
}

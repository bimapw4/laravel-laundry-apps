<?php 
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use App\Services\Auth\AuthManager;
use App\Services\Validator\ValidatorManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function Login(Request $request)
    {
        try {
            (new ValidatorManager)->validateJSON($request, self::ruleLogin());

            $user = Pengguna::where("email", $request->email)->first();

            $authManager = new AuthManager;
            $authManager->checkEmail($user);
            $authManager->checkPassword($request, $user);
            
            $jwt = $authManager->generateJWT($user);

            unset($user["id_pengguna"]);
            
            return [
                "data" => $user,
                "token" => $jwt                
            ];

        } catch (\ValidateException $th) {
        } catch (\UnauthorizedException $th) {
        }
    }

    public function Register(Request $request)
    {
        try {
            (new ValidatorManager)->validateJSON($request, self::ruleRegister());
            
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

    public static function ruleLogin()
    {
        return [
            "email" => "required|email",
            "password" => "required"
        ];
    }

    public static function ruleRegister()
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
}

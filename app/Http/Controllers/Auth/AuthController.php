<?php 
namespace App\Http\Controllers\Auth;

use App\Exceptions\UnauthorizedException;
use App\Http\Controllers\Controller;
use App\Mail\MailForgotPassword;
use App\Models\Pengguna;
use App\Services\Auth\AuthManager;
use App\Services\Mail\MailManajer;
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

    public function sendMailforgotPassword(Request $request)
    {
        try {
            (new ValidatorManager)->validateJSON($request, self::ruleForgotpass());
            $user = Pengguna::where("email", $request->email)->first();

            $email = hash('md5', $request->email);
            $uniqueKey = hash('sha256', $email.date('Y-m-d'));
            $data = [
                "username" => $user->nama_lengkap,
                "link" => env('LINK_FE').$email."-".$uniqueKey
            ];

            (new MailManajer)->mail($request->email, new MailForgotPassword($data));

        } catch (\ValidateException $th) {
        } catch (\UnauthorizedException $th) {
        }
        
    }

    public function getMailforgotPassword($key)
    {
        try {
            $uniqueKey = explode("-", $key); 

            $user = Pengguna::whereRaw("md5(email) = '$uniqueKey[0]'")->first();

            $authManager = new AuthManager;
            $authManager->checkEmail($user);

            if ($uniqueKey[1] !== hash('sha256', $uniqueKey[0].date('Y-m-d'))) {
                throw new UnauthorizedException("expired request for forgot password", 410); 
            }

            return ["data" => $user];
            
        } catch (\UnauthorizedException $th) {
        }
    }

    public function ChangePassword(Request $request)
    {
        try {
            (new ValidatorManager)->validateJSON($request, self::ruleChangePass());

            return Pengguna::where("email", $request->email)->update([
                "password" => Hash::make($request->password)
            ]);

        } catch (\ValidateException $th) {
        }
    }

    public static function ruleLogin()
    {
        return [
            "email" => "required|exists:pengguna,email",
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

    public static function ruleForgotpass()
    {
        return [
            "email" => "required|email|exists:pengguna,email"
        ];
    }

    public function ruleChangePass()
    {
        return [
            "email" => "required|email|exists:pengguna,email",
            "new_password" => "required"
        ];
    }
}

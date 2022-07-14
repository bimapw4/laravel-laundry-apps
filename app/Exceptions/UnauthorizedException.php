<?php
namespace App\Exceptions;

use Illuminate\Http\Response;

class UnauthorizedException  extends \Exception
{
    protected $message;
    protected $stts;
    public function __construct($message, $stts) {
        $this->message = $message;
        $this->stts = $stts;
    }
    public function render()
    {
        return Response(["error" => [
                "message" => $this->message,
                "errors" => [[
                    "domain" => null,
                    "reason" => "UnauthorizedException",
                    "message" => $this->message
                ]]
            ]
        ], $this->stts);
    }
}

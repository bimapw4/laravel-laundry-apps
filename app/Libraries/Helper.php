<?php
namespace App\Libraries;

class Helper
{
    public static function mapErrorsValidator($errors)
    {
        $newErrors = [];

        foreach ($errors as $key => $error) {
            array_push($newErrors, 
                [
                    'reason' => 'ValidationException',
                    'location_type' => 'body',
                    'location' => $key,
                    'message' => $error[0]
                ]
            );
        }

        return [
            'api_version'=> '1.0',
            'error'=> [
                'message'=> 'cannot be processed.',
                'reason' => 'ValidationException',
                'errors'=> $newErrors
            ]
        ];
    }
}

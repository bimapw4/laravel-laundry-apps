<?php

namespace App\Services\Validator;

use App\Exceptions\UnauthorizedException;
use App\Exceptions\UnprocessableEntity;
use App\Exceptions\GeneralException;
use App\Models\Merchant;
use App\Models\Permission;
use App\Models\UserGroup;
use App\Models\UserRole;
use App\Models\UserGroupPermission;
use App\Exceptions\ValidateException;
use App\Libraries\Helper;
use App\Models\UserPermission;
use App\Models\UserRolePermission;

class ValidatorManager
{
    public function validateJSON($request, $rule)
    {
        $validator = \Validator::make($request->all(), $rule);
        
        if ($validator->fails()) {
            $validatorResult = Helper::mapErrorsValidator($validator->errors()->toArray());

            throw new ValidateException($validatorResult);
        }

        return $validator->validated();
    }
}

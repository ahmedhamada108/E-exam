<?php

namespace App\Http\Controllers\Student\API;

use App\Models\levels;
use App\Models\students;
use App\Models\departments;
use Illuminate\Http\Request;
use App\Http\Traits\ResponseTrait;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Traits\ResponseTraits;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller as BaseController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AuthAPI extends BaseController
{
    use ResponseTrait;
    public function LevelsAndDept()
    {
        $levels = levels::select(
            'id',
            'name_' . app()->getLocale() . ' as name'
        )->get();
        $departments = departments::select(
            'id',
            'name_' . app()->getLocale() . ' as name'
        )->get();

        return response()->json([
            'status' => true,
            'errNum' => "S000",
            'msg' => "success",
            'The levels' => $levels,
            "The departments" => $departments
        ]);
    }

    public function postRegistration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required| email |unique:students',
            'password' => 'required|min:6| confirmed',
            'level_id' => 'required',
            'dept_id' => 'required',
        ]);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }

        $user = students::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));

        return $this->returnSuccessMessage('The Registeraion request has been sent to the admin');
    }

    public function Login(Request $request)
    {
        ## validation ##
        try {

                $rules = [
                    'email' => "required | exists:students,email",
                    'password' => "required"
                ];
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    $code = $this->returnCodeAccordingToInput($validator);
                    return $this->returnValidationError($code, $validator);
                } // return validation messages

                /// login code wise
                $credentials = $request->only(['email', 'password']);
                $token = auth('student_api')->attempt($credentials);
                if (!$token) {
                    return $this->returnError('E1001', 'error in the password');
                } else {
                    //return token 
                    $student = auth('student_api')->user();
                    $student->Token = $token;
                    if ($student->Is_active == 0) {
                        JWTAuth::setToken($token)->invalidate();
                        return $this->returnError('E2422', 'Your request still pending.');
                        // return request pending message 
                    } else {
                        $student = [
                            'id' =>  $student->id,
                            'name' => $student->name,
                            'email' => $student->email,
                            'token' => $student->Token,
                        ];
                        // filter the response 
                        return $this->returnData('Student', $student, 'login success');
                    }
                }
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function logout(Request $request)
    {

        try {
            $token = $request->bearerToken();
            if ($token) {
                JWTAuth::setToken($token)->invalidate();
                return $this->returnSuccessMessage('Logout successfully');
            } else {
                return $this->returnError('E500', 'Token invalid');
            }
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }
}

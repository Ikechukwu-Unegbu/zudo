<?php

namespace App\Http\Controllers\V1\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\V1\Admin\Channel;
use App\Models\V1\Admin\Transaction;
use App\Services\SMSService;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    public function AdminRegistration(Request $request)
    {
        if ($request->wantsJson())
        {
            $validator = Validator::make($request->all(), [
                'name'  =>  'required|string',
                'username'  =>  'required|string|unique:users,name',
                'email'     =>  'required|email|unique:users,email',
                'password'  =>  'required|string|min:6',
                'password_confirmation'  =>  'required|same:password'
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validator->errors()
                ], 401);
            }

            $user = User::create([
                'name'  =>  $request->username,
                'fullname'  =>  $request->name,
                'email'     =>  $request->email,
                'password'  =>  bcrypt($request->password),
                'access'    =>  'admin',
            ]);

            $token = $user->createToken('API TOKEN')->plainTextToken;

            return response()->json([
                'message' => 'Admin Created Successfully',
                'user'  =>  $user,
                'token' => $token
            ]);
        }
        else
        {
            return null;
        }
    }

    public function ChannelRegistration(Request $request)
    {
        if ($request->wantsJson())
        {
            $validator = Validator::make($request->all(), [
                'name'  =>  'required|string',
                'username'  =>  'required|string|unique:users,name',
                'email'     =>  'required|email|unique:users,email',
                'password'  =>  'required|string|min:6',
                'password_confirmation'  =>  'required|same:password'
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validator->errors()
                ], 401);
            }

            $user = User::create([
                'name'  =>  $request->username,
                'fullname'  =>  $request->name,
                'email'     =>  $request->email,
                'password'  =>  bcrypt($request->password),
                'access'    =>  'channel',
            ]);

            $token = $user->createToken('API TOKEN')->plainTextToken;

            return response()->json([
                'message' => 'Channel Created Successfully',
                'user'  =>  $user,
                'token' => $token
            ]);
        }
        else
        {
            return null;
        }
    }

    public function AdminLogin(Request $request)
    {
        if ($request->wantsJson()) {
            $validator = Validator::make($request->all(), [
                'email'     =>  'required|email',
                'password'  =>  'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validator->errors()
                ], 401);
            }

            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized!, check your login credentials',
                ], 401);
            }

            $user = $request->user();

            if ($user->access == 'admin') {
                $token = $user->createToken('API TOKEN')->plainTextToken;
                return response()->json([
                    'status' => true,
                    'message' => 'User Logged In Successfully',
                    'username'  =>  $user->name,
                    'access'  =>  $user->access,
                    'token' => $token,
                ], 200);
            }

            return response()->json([
                'message'   =>  "You are not authorized to access the page!"
            ]);
        }
        else
        {
            return null;
        }

    }

    public function ChannelLogin(Request $request)
    {
        if ($request->wantsJson())
        {
            $validator = Validator::make($request->all(), [
                'email'     =>  'required|email',
                'password'  =>  'required|string',
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validator->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized!, check your login credentials',
                ], 401);
            }

            $user = $request->user();
            if ($user->access == 'channel')
            {
                $token = $user->createToken('API TOKEN')->plainTextToken;
                return response()->json([
                    'status' => true,
                    'message' => 'User Logged In Successfully',
                    'username'  =>  $user->name,
                    'access'  =>  $user->access,
                    'token' => $token,
                ], 200);
            }

            return response()->json([
                'message'   =>  "You are not authorized to access the page!"
            ]);
        }
        else
        {
            return null;
        }

    }

    public function forgotPassword(Request $request)
    {
        if ($request->wantsJson())
        {
            $this->validate($request, [
                'email' =>  'required|email',
            ]);

            $checkEmailStatus = Password::sendResetLink($request->only('email'));

            if ($checkEmailStatus == Password::RESET_LINK_SENT)
            {
                return ['status' => __($checkEmailStatus)];
            }

            throw ValidationException::withMessages([
                'email' =>  [trans($checkEmailStatus)]
            ]);
        }
        else
        {
            return null;
        }
    }

    public function resetPassword(Request $request)
    {
        if ($request->wantsJson())
        {
            $this->validate($request, [
                'token' =>  'required',
                'email' =>  'required|email',
                'password'  =>  'required|confirmed|min:6',
            ]);

            $status = Password::reset(
                    $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->forceFill([
                        'password' => bcrypt($password)
                    ])->setRememberToken(Str::random(60));

                    $user->save();

                    event(new PasswordReset($user));
                }
            );

            return $status === Password::PASSWORD_RESET ? response()->json(['message' => 'Password reset Successfully']) : response()->json(['message' => __($status)]);
        }
        else
        {
            return null;
        }
    }

    public function logout(Request $request)
    {
        if ($request->wantsJson())
        {
            $request->user()->currentAccessToken()->delete();
            return response()->json([
                'message'   =>  "User Logged out Successfully"
            ]);
        }
        else
        {
            return null;
        }
    }

    public function AdminToCreateChannel(Request $request, User $user)
    {
        if ($request->wantsJson() && auth()->user()->access == 'admin')
        {
            $validator = Validator::make($request->all(), [
                'name'      =>  'required|string',
                'username'  =>  'required|string|unique:users,name',
                'email'     =>  'required|email|unique:users,email',
                'mobile'    =>  'required|min:11|max:11|unique:users,phone',
                'gender'    =>  'required|string',
                'password'  =>  'required|string|min:6',
                'password_confirmation' =>  'required|string|same:password',
                'description'=> 'required|string',
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validator->errors()
                ], 401);
            }

            $user = User::create([
                'fullname'  =>  $request->name,
                'name'      =>  $request->username,
                'email'     =>  $request->email,
                'phone'     =>  $request->mobile,
                'gender'     =>  $request->gender,
                'password'  =>  bcrypt($request->password),
                'channel_description'   =>  $request->description,
                'access'     => 'channel'
            ]);

            $token = $user->createToken('API TOKEN')->plainTextToken;

            return response()->json([
                'message' => 'Channel Created Successfully',
                'user'  =>  $user,
                'token' => $token
            ]);

        }
        else {
            return null;
        }
    }

    public function channels(Request $request)
    {
        if ($request->wantsJson() && auth()->user()->access == 'admin')
        {
            $channels = User::whereAccess('channel')->orderBy('created_at', 'DESC')->get();
            return response()->json($channels);
        }
        else{
            return null;
        }
    }

    public function AssignedUser()
    {
        if(request()->wantsJson() && auth()->user()->access == 'channel')
        {
            $assignedUser = User::whereAccess('user')->whereChannelId(auth()->user()->id)->orderBy('id', 'ASC')->get();
            return response()->json($assignedUser);
        }
        else
        {
            return null;
        }
    }

    public function contribution()
    {
        if(request()->wantsJson() && auth()->user()->access == 'channel')
        {
            $contributions = Transaction::with('customer')->whereAgentId(auth()->user()->id)->orderBy('created_at', 'DESC')->get();
            return response()->json($contributions);
        }
        else
        {
            return null;
        }
    }

    public function createContribution(Request $request)
    {
        if(request()->wantsJson() && auth()->user()->access == 'channel')
        {

            $validator = Validator::make($request->all(), [
                'amount'=>'required|string',
                'userId'  =>  'required|integer',
                'purpose' => 'nullable|string'
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validator->errors()
                ], 401);
            }


            $type ='';
            $trx = new Transaction();
            $trx->amount = $request->amount;
            $trx->customer_id = $request->userId;
            $trx->agent_id = auth()->user()->id;
            $trx->purpose = $request->purpose ? $request->purpose : $request->input('purpose', 'Contribution');
            $trx->trx_type = 1;
            $trx->save();
            $customer = User::find($request->userId);
            //send sms to the user

            // $smsService = new SMSService();
            // $message ='';
            // if($request->type == 1){
            //     $message = "Your contribution of N".$request->amount." received.";
            // }
            // else{
            //     $message = "Your debit of N".$request->amount." is being processed.";
            // }
            // $smsresponse = $smsService->senderSMS($message, $customer->phone, 'Spartan');
            // $smsService->logsms($smsresponse, $trx);

            return response()->json([
                'message' => 'Contribution/Debit Created Successfully',
                'amount'  =>  $trx->amount,
                'user'    =>  $trx->customer->name,
                'purpose' =>  $trx->purpose
            ]);
        }
        else
        {
            return null;
        }
    }
}

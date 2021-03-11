<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Validator;
use App\Http\Controllers\api\TraitApi;
use App\Models\User;
use App\Models\RoleUser;

class UserController extends Controller
{
    use TraitApi;

    /**
     * login function
     */
    public function login()
    {
        if(Auth::attempt(['email' => request('email'),'password' => request('password')])){
            $username = Auth::user();
            $check_role = RoleUser::where('id',$username->id)
                            ->where('is_delete',0)
                            ->where('status','active')
                            ->where('position','super_admin')
                            ->first();
            $username['token'] = ($check_role) ? $username->createToken('nApp')->accessToken : null;
            return $this->responseApi('ok',$username,'Login Success');
        }else{
            return $this->responseApi('error','','Something went wrong');
        }
    }

    /**
     * register username 
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'          => 'required',
            'email'             => 'required|email',
            'password'          => 'required',
            'confirm_password'  => 'required|same:password',
        ]);
        if($validator->fails()){
            return $this->responseApi('error','',$validator->errors());
        }

        $data                   = $request->all();
        $data['password']       = bcrypt($data['password']);
        $user                   = User::create($data);
        $msg['token']           = $user->createToken('nApp')->accessToken;
        $msg['name']            = $user->name;

        RoleUser::create();
        
        return $this->responseApi('ok',$msg,'Register success');
    }

    /**
     * logout user
     */
    public function logout(Request $request)
    {
        $logout = $request->user()->token()->revoke();
        if($logout){
            return $this->responseApi('ok','','Successfully log out');
        }else{
            return $this->responseApi('error','','Something went wrong');
        }
    }

    /**
     * user list
     */
    public function userList()
    {
        $data = User::join('role_user','role_user.id','users.id')->where('role_user.is_delete',0)->where('role_user.position','!=','super_admin')->get();
        if($data){
            return $this->responseApi('ok',$data,'Successfully log out');
        }else{
            return $this->responseApi('error','','Something went wrong');
        }        
    }
}

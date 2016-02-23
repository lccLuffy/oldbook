<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Gate;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Validator;

require_once __DIR__ . '/../../../tools/UESTC.php';

class AuthController extends Controller
{

    protected $username = 'stu_num';

    protected $redirectPath = '/';
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use UestcController, AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout', 'update']]);
        $this->middleware('auth', ['only' => ['update']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nickname' => 'required|max:16|min:3',
            'stu_num' => 'required|unique:users',
            'stu_psw' => 'required',
            'email' => 'required|email|max:255|unique:users',
        ],
            [
                'nickname.required' => '昵称不能为空',
                'nickname.max' => '昵称太长，最长16',
                'nickname.min' => '昵称太短，最短3',
                'stu_num.required' => '学号不能为空',
                'stu_psw.required' => '密码不能为空',
                'email.required' => '邮箱不能为空',
            ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['stu_num'],
            'email' => $data['email'],
            'password' => bcrypt($data['stu_psw']),
            'stu_num' => $data['stu_num'],
            'user_info' => $this->student_data['json'],
            'address' => $data['address'],
            'nickname' => $data['nickname'],
        ]);
    }

    public function update(Request $request)
    {
        $file = $request->file('avatar');

        if ($file && !$file->isValid()) {
            return back()->withInput()->withErrors('图片上传失败');
        }

        $this->validate($request, [
            'nickname' => 'required|max:16|min:3',
            'phone_number' => 'max:25',
            'avatar' => 'image|max:200'
        ],
            [
                'nickname.required' => '昵称不能为空',
                'nickname.max' => '昵称太长，最长16',
                'nickname.min' => '昵称太短，最短3',
            ]);

        $target_user = User::findOrFail($request['user_id']);
        if (Gate::denies('update.user', $target_user)) {
            abort(403);
        }

        if ($file && $file->isValid()) {
            $finalName = 'avatar_' . $target_user->stu_num . '_' . Hash::make($target_user->id);
            $content = File::get($file->getRealPath());
            $disk = Storage::disk('qiniu');
            if ($disk->put($finalName, $content)) {
                $target_user->avatar = $disk->getDriver()->downloadUrl($finalName);
            } else {
                return back()->withInput()->withErrors('图片上传失败');
            }
        }

        $target_user->nickname = $request['nickname'];
        $target_user->phone_number = $request['phone_number'];
        $target_user->address = $request['address'];

        if ($target_user->update()) {
            return back()->withInput()->withSuccess('修改成功');
        }
        return back()->withInput()->withErrors('修改失败');
    }
}

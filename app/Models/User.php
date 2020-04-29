<?php

namespace App\Models;

use App\Mail\DemoEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use stdClass;
use Symfony\Component\Console\Input\Input;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','surname','patronymic','address','number','sex','role','birthday'
    ];

    /**
     * The attributes that should be hidden for arrays.rr
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function send($name,$email,$password)
    {
        $objDemo = new stdClass();
        $objDemo->login = $email;
        $objDemo->password = $password;
        $objDemo->sender = 'LaravelIt';
        $objDemo->receiver = $name;

        Mail::to($email)->send(new DemoEmail($objDemo));
    }

    public function  prepareFromCreate($user)

    {
        if($this->uniqueEmail($user['email']))
        {
            $password = $user['password'];
            $user['password'] = bcrypt($user['password']);

//            Storage::disk('local')->put('file.txt', 'Contents');


            $user=User::create($user);
            $fullName = $user->surname.' '.$user->name.' '.$user->patronymic;
            $this->send($fullName,$user->email,$password);

            return ['response'=>'created'];
        }
        else {

            return ['response'=>'emailDuplicate'];
        }

    }

    public function uniqueEmail($email)
    {
        $check = User::where('email',$email)->first();

        if($check){

            return false;
        }

        return true;
    }

    public function noGrade() {

        return DB::table('users')
            ->leftJoin('grades','users.id','=','grades.user_id')
            ->where('grades.user_id',null)
            ->where('users.role','<>','Ученик');
    }

    public function getAllTeachers() {

        return DB::table('users')
            ->where('users.role','<>','Ученик')
            ->where('users.role','<>','Админ');
    }

    public function getStudents() {

        return DB::table('users')
            ->where('users.role','=','Ученик');
    }

    public function getAll()
    {

        return DB::table('users');
    }

    public function groupFullName($users)
    {
        $result=[];

        foreach($users as $user)
        {
            $row=[];
            $row['id'] =  $user->id;
            $row['fullName'] = $user->surname.' '.$user->name." ".$user->patronymic;

            array_push($result,$row);
        }

        return $result;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    use HasFactory;

    protected $table ='officers' ;

    //เพิ่ม getter ไปยัง json 
    protected $appends = ['fullname', 'age', 'picture_url'];
    
    protected $hidden = ['picture'];

    //getter (Accessor)
    public function getFullnameAttribute(){//fullname
        return $this->firstname . '' . $this->lastname;
    }
    public function getAgeAttribute(){//age
        return now()->diffInYears($this->dob);
    }
    
    public function getPictureUrlAttribute(){//PictureUrl
        return asset('storage/upload').'/'. $this->picture;
    }

    //manny to one 
    public function department(){
        //return $this->belongsToMany(Department::class);//autoตามกฏ
       return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }
}

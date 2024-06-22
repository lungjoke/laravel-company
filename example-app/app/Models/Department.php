<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table ='departments' ;
    //protected $primaryKey = 'd_id'; ในกรณีที่ PK เป้นชื่ออื่นไม่ใช่ id 
    //protected $KeyType = 'string '; ในกรณีที่ PK ไม่ใช่ int เป็น varchar
    //public $incerememting = false; ในกรณีที่ PK ไมไ่ด้เป็น auto_increment 
    //public $timestemps = false; ในกรณีที่ ตารางไม่มีคอลลัม created_at  updated_at ในตาราง
    
    //one to many
    public function officers(){
        //return $this->hasMany(Officer::class);//autoตามกฏ
        return $this->hasMany(Officer::class, 'department_id', 'id');
    }

}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$d = Department::all();//select * ftom department
        //$d = Department:: find(2);
        //$d = Department::where('name','like','%บ%')->get();
        //$d = Department::select('id','name')->orderBy('id','desc')->get();
        //$d = DB::select('select * from departments order by id desc');
        //$total = Department::count();
        
        // return response()->json([
        //    'total'=>$total,
        //   'data'=> $d
        //], 200);
        //pagination
        //{{url}}api/department?page=1&page_size=2
        $page_size = request()->query('page_size');
        $pagesize = $page_size == null ? 5 : $page_size;

       // $d = Department::paginate($pagesize);    
        //$d = Department::orderBy('id','desc')->with(['officers'])->paginate($pagesize);
        $d = Department::orderBy('id','desc')->with(['officers'=>function($query){
            $query->orderBy('salary','desc');
        }])->paginate($pagesize);
        return response()->json($d, 200);

    }
    //ค้นหาชื่อแผนก
    public function search(){
        $query = request()->query('name');
        $keyword = '%'.$query.'%';
        $d = Department::where('name','like', $keyword)->get();

        if ($d->isEmpty()){
            return response()->json([
                'errors'=>[
                    'status_code'=> 404,
                    'message'=>'ไม่พบข้อมูล']
        ],404);//http status code
        }

        return response()->json([
            'data'=>$d
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $d = new Department();
        $d->name = $request->name;
        $d->save();
        return response()->json([
            'message'=> 'เพิ่มข้อมูลสำเร็จ',
            'data' => $d
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $d = Department::find($id);
        if($d == null){
            return response()->json([
                'errors'=>[
                    'status_code'=> 404,
                    'message'=>'ไม่พบข้อมูลผู้ใช้งาน']
        ],404);//http status code
        }
        return response()->json($d,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if ($id !=$request->id){
            return response()->json([
                'error'=>[
                    'status_code'=>400,
                    'message' => 'รหัสแผนกไม่ตรงกัน'
                ]
                ],404);
        }

        $d = Department::find($id);
        $d -> name = $request -> name;
        $d->save();

        return response()->json([
            'message'=> 'แก้ไขข้อมูลเรียบร้อย',
            'data'=> $d
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $d = Department::find($id);
        if($d == null){
            return response()->json([
                'errors'=>[
                    'status_code'=> 404,
                    'message'=>'ไม่พบข้อมูลผู้ใช้งาน']
        ],404);//http status code
        }
        //ลบ
        $d->delete();
        return response()->json([
            'message'=>'ลบข้อมูลเรียบร้อย'
        ],200);
    }
}

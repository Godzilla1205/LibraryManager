<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\employees;

class EmployeesController extends Controller
{
    public function getManagerEmployees(){
        $employeess = employees::all()->toArray();
        $stt = 0;
        return view("layout.managerEmployees",compact('employeess','stt'));
    }
	 public function getManagerEmployees_Add() {
        return view("event.managerEmployees_Add");
    }

    public function getManagerEmployees_Delete($id) {
        $employee = employees::find($id);
        $employee->delete();
        return back();
    }

    public function getManagerEmployees_Edit($id) {
         $employee = employees::find($id);
         return view("event.managerEmployees_Edit",compact('employee','id'));
    }

     public function postManagerEmployees_Edit(Request $request, $id) {
        $employees = employees::find($id);
        $this->validate(request(), [
             'maSoNV' => 'required|min:2|max:50',
             'hoTenNV'=> 'required|min:2|max:100',
             'diaChiNV' => 'max:100',
             'ngaySinhNV'=> 'nullable|date',
             'gioiTinhNV'=> 'nullable|max:1|numeric',
             'soDTNV'=> 'nullable|numeric',
             'emailNV'=> 'max:200',
             'ngayVaoLam'=> 'nullable|date',
             'avatar'=> 'nullable'
        ]
        ,[
            'required' => ':attribute không được để trống',
            'min' => ':attribute không được nhỏ hơn :min',
            'max' => ':attribute không được lớn hơn :max',
            'numeric' => ':attribute chỉ được nhập số',
            'date' => ':attribute không đúng',
            'unique' => ':attribute đã tồn tại'
        ],
        [
            'maSoNV' => 'Mã số nhân viên',
            'hoTenNV' => 'Họ tên nhân viên',
            'diaChiNV' => 'Địa chỉ nhân viên',
            'soDTNV'=> 'Số điện thoại nhân viên',
            'emailNV'=> 'Email nhân viên',
            'ngaySinhNV'=> 'Ngày sinh',
            'ngayVaoLam'=> 'Ngày vào làm'
        ]);

        $employees->maSoNV = $request->get('maSoNV');
        $employees->hoTenNV = $request->get('hoTenNV');
        $employees->diaChiNV = $request->get('diaChiNV');
        $employees->ngaySinhNV = date("Y-m-d",strtotime($request->get('ngaySinhNV')));
        $employees->gioiTinhNV = $request->get('gioiTinhNV');
        $employees->soDTNV = $request->get('soDTNV');
        $employees->emailNV = $request->get('emailNV');
        $employees->ngayVaoLam = date("Y-m-d",strtotime($request->get('ngayVaoLam')));
        $employees->avatar = $request->get('avatar');
        $employees->save();

        if($request->hasFile('fileAvatar')) {    
        $file = $request->file('fileAvatar');
        $fileName = $file->getClientOriginalName('fileAvatar');
        $file->move('images/employees', $fileName);
       } else {}

        return back()->with('success', 'Readers has been added');
    }

    

    
     public function postManagerEmployees_Add(Request $request){
       $employees = $this->validate(request(), [
             'maSoNV' => 'required|min:2|max:50|unique:employees,maSoNV',
             'hoTenNV'=> 'required|min:2|max:100',
             'diaChiNV' => 'max:100',
             'ngaySinhNV'=> 'nullable|date',
             'gioiTinhNV'=> 'nullable|max:1|numeric',
             'soDTNV'=> 'nullable|numeric',
             'emailNV'=> 'max:200',
             'ngayVaoLam'=> 'nullable|date',
             'avatar'=> 'nullable'
        ]
        ,[
        	'required' => ':attribute không được để trống',
            'min' => ':attribute không được nhỏ hơn :min',
            'max' => ':attribute không được lớn hơn :max',
            'numeric' => ':attribute chỉ được nhập số',
            'date' => ':attribute không đúng',
            'unique' => ':attribute đã tồn tại'
        ],
        [
            'maSoNV' => 'Mã số nhân viên',
            'hoTenNV' => 'Họ tên nhân viên',
            'diaChiNV' => 'Địa chỉ nhân viên',
            'soDTNV'=> 'Số điện thoại nhân viên',
            'emailNV'=> 'Email nhân viên',
            'ngaySinhNV'=> 'Ngày sinh',
            'ngayVaoLam'=> 'Ngày vào làm'
        ]);
       $employees['ngaySinhNV'] = date("Y-m-d",strtotime($employees['ngaySinhNV']));
       $employees['ngayVaoLam'] = date("Y-m-d",strtotime($employees['ngayVaoLam']));

       
       employees::create($employees);
       if($request->hasFile('fileAvatar')) {    
        $file = $request->file('fileAvatar');
        $fileName = $file->getClientOriginalName('fileAvatar');
        $file->move('images/employees', $fileName);
       } else {}
       return back()->with('success', 'Publisher has been added');
    }

}

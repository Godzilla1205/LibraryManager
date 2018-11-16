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
	 public function getManagerEmployees_Add(){
        return view("event.managerEmployees_Add");
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
             'avatar'=> 'max:500'
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
       if($request->hasFile('avatar')) {    
        $file = $request->file('avatar');
        $fileName = $file->getClientOriginalName('avatar');
        $file->move('images/employees', $fileName);
       } else {}
       return back()->with('success', 'Publisher has been added');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\publisher;

class PublisherController extends Controller
{
     public function getManagerPublisher(){
        $publishers = publisher::all()->toArray();
        $stt = 0;
        return view("layout.managerPublisher",compact('publishers','stt'));
    }
    public function getManagerPublisher_Add(){
        return view("event.managerPublisher_Add");
    }

    public function postManagerPublisher_Add(Request $request){
        $publisher = $this->validate(request(), [
            'maSoNXB' =>  'required|min:2|max:100|unique:publishers,maSoNXB',
            'hoTenNXB' => 'required|min:2|max:100',
            'diaChiNXB' => 'max:200',
            'websiteNXB' => 'max:200',
            'thongTinKhacNXB' => 'max:200'
        ]);   //unique:publisher
        publisher::create($publisher);
        return back()->with('success', 'Publisher has been added');
    }

    public function getManagerPublisher_Edit($id){
         $publisher = publisher::find($id);
         return view('event.managerPublisher_Edit',compact('publisher','id'));
    }
    public function postManagerPublisher_Edit(Request $request, $id){
        $publisher = publisher::find($id);
        $this->validate(request(),[
            'maSoNXB' =>  'required|min:2|max:100|unique:publishers,maSoNXB',
            'hoTenNXB' => 'required|min:2|max:100',
            'diaChiNXB' => 'max:200',
            'websiteNXB' => 'max:200',
            'thongTinKhacNXB' => 'max:200'
        ]);
        $publisher->maSoNXB = $request->get('maSoNXB');
        $publisher->hoTenNXB = $request->get('hoTenNXB');
        $publisher->diaChiNXB = $request->get('diaChiNXB');
        $publisher->websiteNXB = $request->get('websiteNXB');
        $publisher->thongTinKhacNXB = $request->get('thongTinKhacNXB');
        $publisher->save();
        return redirect("manager/Publisher/Edit/$id")->with('success','Publisher has been updated');
    }
    public function getManagerPublisher_Delete($id){
         $publisher = publisher::find($id);
         $publisher->delete();
         return redirect('manager/Publisher');
    }
   
}




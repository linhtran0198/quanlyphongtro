<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\District;
use App\Categories;
use App\Motelroom;
class UserController extends Controller
{
	/* Register */
   	public function get_register(){
         $categories = Categories::all();
   		return view('home.register',['categories'=>$categories]);
   	}

   	public function post_register(Request $req){
   		
   		$req->validate([
   			'txtuser' => 'required|unique:users,username',
   			'txtmail' => 'required|email|unique:users,email',
   			'txtpass' => 'required|min:6',
   			'txt-repass' => 'required|same:txtpass',
   			'txtname' => 'required'
   		],[
   			'txtuser.required' => 'Vui lòng nhập tài khoản',
   			'txtuser.unique' => 'Tài khoản đã tồn tại trên hệ thống',
   			'txtmail.unique' => 'Email đã tồn tại trên hệ thống',
   			'txtmail.required' => 'Vui lòng nhập Email',
   			'txtpass.required' => 'Vui lòng nhập mật khẩu',
   			'txtpass.min' => 'Mật khẩu phải lớn hơn 6 kí tự',
   			'txt-repass.required' => 'Vui lòng nhập lại mật khẩu',
   			'txt-repass.same' => 'Mật khẩu nhập lại không trùng khớp',
   			'txtname.required' => 'Nhập tên hiển thị'
   		]);
   		$newuser = new User;
   		$newuser->username = $req->txtuser;
   		$newuser->name = $req->txtname;
   		$newuser->password = bcrypt($req->txtpass);
   		$newuser->email = $req->txtmail;
   		$newuser->save();
   		return redirect('/user/register')->with('success','Đăng kí thành công');
   	}
   	/* Login */
   	public function get_login(){
         $categories = Categories::all();
   		return view('home.login',['categories'=>$categories]);
   	}

   	public function post_login(Request $req){
   		$req->validate([
   			'txtuser' => 'required',
   			'txtpass' => 'required',
   			
   		],[
   			'txtuser.required' => 'Vui lòng nhập tài khoản',
   			'txtpass.required' => 'Vui lòng nhập mật khẩu'
   			
   		]);
   		if(Auth::attempt(['username'=>$req->txtuser,'password'=>$req->txtpass])){
    		return redirect('/');
    	}
    	else 
    		return redirect('user/login')->with('warn','Tài khoản hoặc mật khẩu không đúng');	
   	}
   	public function logout(){
   		Auth::logout();
		return redirect('user/login');
   	}
      public function getprofile(){
         $mypost = Motelroom::where('user_id',Auth::user()->id)->get();
         $categories = Categories::all();
         return view('home.profile',[
            'categories'=>$categories,
            'mypost'=> $mypost
         ]);
      }

      public function getEditprofile(){
         $user = User::find(Auth::user()->id);
         $categories = Categories::all();
         return view('home.edit-profile',[
            'categories'=>$categories,
            'user'=> $user
         ]);
      }
      public function postEditprofile(Request $request){
         $categories = Categories::all();
         $user = User::find(Auth::id());
         if ($request->hasFile('avtuser')){
            $file = $request->file('avtuser');
            var_dump($file);
            $exten = $file->getClientOriginalExtension();
            if($exten != 'jpg' && $exten != 'png' && $exten !='jpeg' && $exten != 'JPG' && $exten != 'PNG' && $exten !='JPEG' )
                return redirect('user/profile/edit')->with('thongbao','Bạn chỉ được upload hình ảnh có định dạng JPG,JPEG hoặc PNG');
            $Hinh = 'avatar-'.$user->username.'-'.time().'.'.$exten;
            while (file_exists('uploads/avatars/'.$Hinh)) {
                 $Hinh = 'avatar-'.$user->username.'-'.time().'.'.$exten;
            }
            if(file_exists('uploads/avatars/'.$user->avatar))
               unlink('uploads/avatars/'.$user->avatar);

            $file->move('uploads/avatars',$Hinh);
            $user->avatar = $Hinh;
         }
         $this->validate($request,[
               'txtname' => 'min:3|max:20'
            ],[
               'txtname.min' => 'Tên phải lớn hơn 3 và nhỏ hơn 20 kí tự',
               'txtname.max' => 'Tên phải lớn hơn 3 và nhỏ hơn 20 kí tự'
         ]);
         if(($request->txtpass != '' ) || ($request->retxtpass != '')){
            $this->validate($request,[
               'txtpass' => 'min:3|max:32',
               'retxtpass' => 'same:txtpass',
            ],[
               'txtpass.min' => 'password phải lớn hơn 3 và nhỏ hơn 32 kí tự',
               'txtpass.max' => 'password phải lớn hơn 3 và nhỏ hơn 32 kí tự',
               'retxtpass.same' => 'Nhập lại mật khẩu không đúng',
               'retxtpass.required' => 'Vui lòng nhập lại mật khẩu',
            ]);
            $user->password = bcrypt($request->txtpass);
         }
         
         $user->name = $request->txtname;
         $user->save();
         return redirect('user/profile/edit')->with('thongbao','Cập nhật thông tin thành công');
         
         // return view('home.edit-profile',[
         //    'categories'=>$categories,
         //    'user'=> $user
         // ]);
      }
   	/* Đăng tin */
   	public function get_dangtin(){
         $district = District::all();
         $categories = Categories::all();
   		return view('home.dangtin',[
            'district'=>$district,
            'categories'=>$categories
         ]);
   	}
      public function post_dangtin(Request $request){

         $request->validate([
            'txttitle' => 'required',
            'txtaddress' => 'required',
            'txtprice' => 'required',
            'txtarea' => 'required',
            'txtphone' => 'required',
            'txtdescription' => 'required',
            'txtaddress' => 'required',
         ],
         [  
            'txttitle.required' => 'Nhập tiêu đề bài đăng',
            'txtaddress.required' => 'Nhập địa chỉ phòng trọ',
            'txtprice.required' => 'Nhập giá thuê phòng trọ',
            'txtarea.required' => 'Nhập diện tích phòng trọ',
            'txtphone.required' => 'Nhập SĐT chủ phòng trọ (cần liên hệ)',
            'txtdescription.required' => 'Nhập mô tả ngắn cho phòng trọ',
            'txtaddress.required' => 'Nhập hoặc chọn địa chỉ phòng trọ trên bản đồ'
         ]);
        
         /* Check file */ 
         $json_img ="";
         if ($request->hasFile('hinhanh')){
            $arr_images = array();
            $inputfile =  $request->file('hinhanh');
            foreach ($inputfile as $filehinh) {
               $namefile = "phongtro-".str_random(5)."-".$filehinh->getClientOriginalName();
               while (file_exists('uploads/images'.$namefile)) {
                 $namefile = "phongtro-".str_random(5)."-".$filehinh->getClientOriginalName();
               }
              $arr_images[] = $namefile;
              $filehinh->move('uploads/images',$namefile);
            }
            $json_img =  json_encode($arr_images,JSON_FORCE_OBJECT);
         }
         else {
            $arr_images[] = "no_img_room.png";
            $json_img = json_encode($arr_images,JSON_FORCE_OBJECT);
         }
         /* tiện ích*/
         $json_tienich = json_encode($request->tienich,JSON_FORCE_OBJECT);
         /* ----*/ 
         /* get LatLng google map */ 
         $arrlatlng = array();
         $arrlatlng[] = $request->txtlat;
         $arrlatlng[] = $request->txtlng;
         $json_latlng = json_encode($arrlatlng,JSON_FORCE_OBJECT);

         /* --- */
         /* New Phòng trọ */
         $motel = new Motelroom;
         $motel->title = $request->txttitle;
         $motel->description = $request->txtdescription;
         $motel->price = $request->txtprice;
         $motel->area = $request->txtarea;
         $motel->count_view = 0;
         $motel->address = $request->txtaddress;
         $motel->latlng = $json_latlng;
         $motel->utilities = $json_tienich;
         $motel->images = $json_img;
         $motel->user_id = Auth::user()->id;
         $motel->category_id = $request->idcategory;
         $motel->district_id = $request->iddistrict;
         $motel->phone = $request->txtphone;
         $motel->save();
         return redirect('/user/dangtin')->with('success','Đăng tin thành công. Vui lòng đợi Admin kiểm duyệt');

      }
}

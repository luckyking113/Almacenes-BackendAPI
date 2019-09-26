<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use Image;
use App\Product;
use App\Group;
use App\Warehouse;


class AdminController extends Controller
{
    public $userTree = array();
    
    public function dashboards(Request $request)
    { 
  
        $products = DB::select("SELECT products.*, `category`.`name` as `category_name` FROM `products` "
                    . "INNER JOIN `category` ON(`products`.`category_id` = `category`.`category_id`) order by id desc limit 10");
        
        return view('admin.dashboard', compact('products')); 
      
    }
    
    public function NewCategory(Request $request)
    {
       $parent_category = DB::table('category')->where('parent_id', '=', 0)->get();
       
       return view('admin.add_category', ['parent_category' => $parent_category]);
    }
    
    public function NewUser(Request $request)
    {
       $groups = Group::all();
       
       return view('admin.add_user', ['groups' => $groups]);
    }
    
    public function NewGroup(Request $request)
    {
      return view('admin.add_group');
    }
    
    public function NewWarehouse(Request $request)
    {
      return view('admin.add_warehouse');
    }
    public function NewWarehouseUser(Request $request)
    {
      return view('admin.add_warehouse_user');
    }
    
    public function loadSubCategory($category_id)
    {
         
         // get all stores of logged in vendor
        $options = '';
        if($category_id)
        {
            $categories = DB::table('category')->where([['parent_id', '=', $category_id],])->orderBy('name', 'ASC')->get();

          //  $options = '<option value="">Select Sub Category</option>';
            foreach($categories as $category)
            {
                $options .= "<option value='".$category->category_id."'>".$category->name."</option>";
            }
         }
         echo $options;
        
    }
    
    public function saveCategory(Request $request)
    {
        $category_name = $request->input('name');
        $parent_category_id   = $request->input('parent_category'); 
        $sub_category_id      = $request->input('sub_category');
        $admin_id =  Auth::guard('admin')->id();
        $imageName = '';
        
         if($request->has('file'))
         {
                $file = $request->file('file');
                $image = $file;
                     $input['imagename'] = time().rand().'.'.$image->getClientOriginalExtension();

                     $destinationPath = public_path('/uploads/category/thumbnail');
                     $destinationPath1 = public_path('/uploads/category');
                     
                     $image->move($destinationPath, $input['imagename']);
                   //  $image->move($destinationPath1, $input['imagename']);

//                     $img = Image::make($image->getRealPath());
//                     $img->resize(300, 300, function ($constraint) {
//                         $constraint->aspectRatio();
//                     })->save($destinationPath.'/'.$input['imagename']);
//                     $img->resize(800, 800, function ($constraint) {
//                         $constraint->aspectRatio();
//                     })->save($destinationPath1.'/'.$input['imagename']);

                     $imageName = $input['imagename'];
     
              
            }
        
        $total_category = DB::table("category")->where([['name', '=', $category_name],])->count('category_id');
        if($total_category > 0)
            return redirect('admin/add_category')->with('success', 'Your entered group already existed ');
        else 
        {
            if(empty($parent_category_id))
                $insert = DB::insert("INSERT INTO `category` (flag,name,parent_id,status,image) VALUES(0,'".$category_name."',0,1,'".$imageName."')");
            else if(!empty($parent_category_id) && empty($sub_category_id))
                $insert = DB::insert("INSERT INTO `category` (flag,name,parent_id,status,image) VALUES(1,'".$category_name."',$parent_category_id,1,'".$imageName."')");
            else if(!empty($parent_category_id) && !empty($sub_category_id))
                $insert = DB::insert("INSERT INTO `category` (flag,name,parent_id,status,image) VALUES(2,'".$category_name."',$sub_category_id,1,'".$imageName."')");
            if($insert)
            {
                 return redirect('admin/category_list')->with('success', 'Your category has been saved successfully');
            }
            else
            {
                 return redirect('admin/add_category')->with('success', 'Your category has not been saved ');
            }
            
        }
        
    }
    
    public function saveWareHouseUser(Request $request)
    {
        $user_type = $request->input('user_type');
        $name   = $request->input('name'); 
        $email      = $request->input('email');
        $password = bcrypt($request->input('password'));
        $phone      = $request->input('phone');
        $zip_code      = $request->input('zip_code');
        $address      = $request->input('address');
        
        
        $imageName = '';
        
         if($request->has('file'))
         {
                $file = $request->file('file');
                     $image = $file;
                     $input['imagename'] = time().rand().'.'.$image->getClientOriginalExtension();

                     $destinationPath = public_path('/uploads/warehouse/thumbnail');
                     $destinationPath1 = public_path('/uploads/warehouse');

                     $img = Image::make($image->getRealPath());
                     $img->resize(300, 300, function ($constraint) {
                         $constraint->aspectRatio();
                     })->save($destinationPath.'/'.$input['imagename']);
                     $img->resize(800, 800, function ($constraint) {
                         $constraint->aspectRatio();
                     })->save($destinationPath1.'/'.$input['imagename']);

                     $imageName = $input['imagename'];
     
              
            }
        
        $total_user = User::where('email', $email)->where('user_type','!=','VIP')->count('id');
        if($total_user > 0)
            return redirect('admin/add_warehouse_user')->with('success', 'Your entered user already existed ');
        else 
        {
            $user = new User;
            $user->name = $name;
            $user->email = $email;
            $user->password = $password;
            $user->address = $address;
            $user->zip_code = $zip_code;
            $user->image = $imageName;
            $user->phone = $phone;
            $user->user_type = $user_type;
            $insert = $user->save();
            
            if($insert)
            {
                 return redirect('admin/warehouse_user_list')->with('success', 'The warehouse user has been saved successfully');
            }
            else
            {
                 return redirect('admin/warehouse_user_list')->with('success', 'The warehouse user has not been saved ');
            }
            
        }
        
    }
    
    public function saveEditWareHouseUser(Request $request)
    {
        $user_type = $request->input('user_type');
        $name   = $request->input('name'); 
        $email      = $request->input('email');
        $password = bcrypt($request->input('password'));
        $phone      = $request->input('phone');
        $zip_code      = $request->input('zip_code');
        $address      = $request->input('address');
        
        $id      = $request->input('id');
        
        $user = User::find($id);
           
         if($request->has('file'))
         {
                $file = $request->file('file');
                     $image = $file;
                     $input['imagename'] = time().rand().'.'.$image->getClientOriginalExtension();

                     $destinationPath = public_path('/uploads/warehouse/thumbnail');
                     $destinationPath1 = public_path('/uploads/warehouse');

                     $img = Image::make($image->getRealPath());
                     $img->resize(300, 300, function ($constraint) {
                         $constraint->aspectRatio();
                     })->save($destinationPath.'/'.$input['imagename']);
                     $img->resize(800, 800, function ($constraint) {
                         $constraint->aspectRatio();
                     })->save($destinationPath1.'/'.$input['imagename']);

                     $user->image = $input['imagename'];
     
              
            }
        
        $total_user = User::where('email', $email)->where('user_type','!=','VIP')->where('id','!=',$id)->count('id');
        if($total_user > 0)
            return redirect('admin/add_warehouse_user')->with('success', 'Your entered user already existed ');
        else 
        {
            $user->name = $name;
            $user->email = $email;
            $user->password = $password;
            $user->address = $address;
            $user->zip_code = $zip_code;
            $user->phone = $phone;
            $user->user_type = $user_type;
            $insert = $user->save();
            
            if($insert)
            {
                 return redirect('admin/warehouse_user_list')->with('success', 'The warehouse user has been updated successfully');
            }
            else
            {
                 return redirect('admin/warehouse_user_list')->with('success', 'The warehouse user has not been updated ');
            }
            
        }
        
    }
    
    public function saveGroup(Request $request)
    {
        $group_name = $request->input('name');
       
        $total_group = DB::table("groups")->where([['name', '=', $group_name],])->count('id');
        if($total_group > 0)
           return redirect('admin/add_group')->with('success', 'Your entered group already existed ');
        else 
        {
            $group = new Group;
            $group->name = $group_name;
            $insert = $group->save();
            
            if($insert)
            {
                 return redirect('admin/group_list')->with('success', 'Your group has been saved successfully');
            }
            else
            {
                 return redirect('admin/group_list')->with('success', 'Your group has not been saved ');
            }
            
        }
        
    }
    
    public function saveWareHouse(Request $request)
    {
          $name = $request->input('name');
          $zip_code = $request->input('zip_code');
          $address = $request->input('address');
          $lat = $request->input('lat');
          $lon = $request->input('lon');
       
          $warehouse = new Warehouse;
          $warehouse->name = $name;
          $warehouse->zip_code = $zip_code;
          $warehouse->address = $address;
          $warehouse->lat = $lat;
          $warehouse->lon = $lon;
          
          $insert = $warehouse->save();
            
          if($insert)
          {
              return redirect('admin/warehouse_list')->with('success', 'The warehouse has been saved successfully');
          }
          else
          {
              return redirect('admin/warehouse_list')->with('success', 'The warehouse has not been saved ');
          }
            
      
    }
    
    public function saveEditWareHouse(Request $request)
    {
          $name = $request->input('name');
          $zip_code = $request->input('zip_code');
          $address = $request->input('address');
          $lat = $request->input('lat');
          $lon = $request->input('lon');
       
          $warehouse = Warehouse::find($request->input('id'));
          $warehouse->name = $name;
          $warehouse->zip_code = $zip_code;
          $warehouse->address = $address;
          $warehouse->lat = $lat;
          $warehouse->lon = $lon;
          
          $insert = $warehouse->save();
            
          if($insert)
          {
              return redirect('admin/warehouse_list')->with('success', 'The warehouse has been updated successfully');
          }
          else
          {
              return redirect('admin/warehouse_list')->with('success', 'The warehouse has not been updated ');
          }
            
      
    }
    
    public function saveUser(Request $request)
    {
        $email = $request->input('email');
        $group = $request->input('group');
        $password = bcrypt($request->input('password'));
       
        $total_user = DB::table("users")->where([['email', '=', $email],])->count('id');
        if($total_user > 0)
           return redirect('admin/add_user')->with('success', 'Your entered user already existed ');
        else 
        {
            $user = new User;
            $user->email = $email;
            $user->password = $password;
            $user->group_id = $group;
            $user->user_type = 'VIP';
            
            $insert = $user->save();
            
            if($insert)
            {
                 return redirect('admin/user_list')->with('success', 'The user has been saved successfully');
            }
            else
            {
                 return redirect('admin/user_list')->with('success', 'The user has not been saved ');
            }
            
        }
        
    }
    
    public function CategoryList()
    {
         $admin_id =  Auth::guard('admin')->id();
         
         // get all stores of logged in vendor
         $categories = DB::table('category')->orderBy('name', 'ASC')->get();
         
	 return view('admin.category', ['categories' => $categories]);
    }
    public function UserList()
    {
        $users = User::where('user_type','VIP')->orderBy('created_at', 'desc')->get();
         
	return view('admin.vip_user', ['users' => $users]);
    }
    
    public function GroupList()
    {
         $groups = Group::orderBy('created_at', 'desc')->get();
         
	 return view('admin.group', ['groups' => $groups]);
    }
    
    public function WareHouseList()
    {
         $warehouses = WareHouse::orderBy('created_at', 'desc')->get();
         
	 return view('admin.warehouse', ['warehouses' => $warehouses]);
    }
    
    public function WareHouseUserList()
    {
         $users = User::where('user_type','!=', 'VIP')->orderBy('created_at', 'desc')->get();
         
	 return view('admin.warehouse_user', ['users' => $users]);
    }
    
    public function saveEditCategory(Request $request)
    {
        $category_name = $request->input('name');
        $category_id   = $request->input('category_id');
        $admin_id      =  Auth::guard('admin')->id();
        $parent_category_id   = $request->input('parent_category'); 
        $sub_category_id      = $request->input('sub_category');
        
        if($request->has('file'))
        {
                $file = $request->file('file');
                     $image = $file;
                     $input['imagename'] = time().rand().'.'.$image->getClientOriginalExtension();

                     $destinationPath = public_path('/uploads/category/thumbnail');
                     $destinationPath1 = public_path('/uploads/category');

                     $img = Image::make($image->getRealPath());
                     $img->resize(300, 300, function ($constraint) {
                         $constraint->aspectRatio();
                     })->save($destinationPath.'/'.$input['imagename']);
                     $img->resize(800, 800, function ($constraint) {
                         $constraint->aspectRatio();
                     })->save($destinationPath1.'/'.$input['imagename']);

                     $imageName = $input['imagename'];
     
              
         }
         else
           $imageName = $request->input('category_image');  
            
        
        $total_category = DB::table("category")->where([['name', '=', $category_name],['category_id', '!=', $category_id],])->count('category_id');
        if($total_category > 0)
            echo 2;
        else 
        {
            if(empty($parent_category_id))
                $update = DB::update("UPDATE `category` SET name = '".$category_name."',parent_id= 0,status = 1,image='".$imageName."' WHERE `category_id` = $category_id");
            else if(!empty($parent_category_id) && empty($sub_category_id))
                $update = DB::update("UPDATE `category` SET name = '".$category_name."',parent_id= $parent_category_id,status = 1,image='".$imageName."' WHERE `category_id` = $category_id");
            else if(!empty($parent_category_id) && !empty($sub_category_id))
                $update = DB::update("UPDATE `category` SET name = '".$category_name."',parent_id= $sub_category_id,status = 1,image='".$imageName."' WHERE `category_id` = $category_id");
            if($update)
            {
                 return redirect('admin/category_list')->with('success', 'Your category has been updated successfully');
            }
            else
            {
                return redirect('admin/category_list')->with('success', 'Your category has not been updated');
            }
            
        }
        
    }
    
    
    public function saveEditGroup(Request $request)
    {
        $group_name = $request->input('name');
        $id = $request->input('id');
        
        $total_group = DB::table("groups")->where([['name', '=', $group_name],['id', '!=', $id],])->count('id');
        if($total_group > 0)
            return redirect('admin/group_edit/'.$id)->with('success', 'The group is already existed');
        else 
        {
            $group = Group::find($id);
            $group->name = $group_name;
            $update = $group->save();
            
            if($update)
            {
                 return redirect('admin/group_list')->with('success', 'The group has been updated successfully');
            }
            else
            {
                return redirect('admin/group_list')->with('success', 'The group has not been updated');
            }
            
        }
        
    }
    
    public function saveEditUser(Request $request)
    {
        $email = $request->input('email');
        $id = $request->input('id');
        $group = $request->input('group');
        
        $total_user = DB::table("users")->where([['email', '=', $email],['id', '!=', $id],])->count('id');
        if($total_user > 0)
            return redirect('admin/user_edit/'.$id)->with('success', 'The user is already existed');
        else 
        {
            $user = User::find($id);
            $user->email = $email;
            $user->group_id = $group;
            
            $update = $user->save();
            
            if($update)
            {
                 return redirect('admin/user_list')->with('success', 'The user has been updated successfully');
            }
            else
            {
                return redirect('admin/user_list')->with('success', 'The user has not been updated');
            }
            
        }
        
    }
    public function CategoryEdit(Request $request, $category_id)
    {
       $category = DB::table('category')->where('category_id', '=', $category_id)->get();
       $sub_category_id = '';
       $parent_category_id = '';
       if($category[0]->flag == 2)
       {
           $sub_category = DB::table('category')->where('category_id', '=', $category[0]->parent_id)->get();
           $sub_category_id = $category[0]->parent_id;
           $parent_category = DB::table('category')->where('category_id', '=', $sub_category[0]->parent_id)->get();
           $parent_category_id = $sub_category[0]->parent_id;
          
       }
       else if($category[0]->flag == 1)
       {
          $parent_category_id = $category[0]->parent_id;
       }
       
       return view('admin.category_edit', ['flag'=>$category[0]->flag, 'category' => $category[0],'sub_category_id'=>$sub_category_id,'parent_category_id'=>$parent_category_id]);
    }
    
    public function GroupEdit(Request $request, $group_id)
    {
       $group = Group::find($group_id);
     
       return view('admin.group_edit', [ 'group' => $group]);
    }
    
    public function WareHouseEdit(Request $request, $warehouse_id)
    {
       $warehouse = Warehouse::find($warehouse_id);
     
       return view('admin.warehouse_edit', [ 'warehouse' => $warehouse]);
    }
    
    public function WareHouseUserEdit(Request $request, $warehouse_id)
    {
       $user = User::find($warehouse_id);
     
       return view('admin.warehouse_user_edit', [ 'user' => $user]);
    }
    
    public function UserEdit(Request $request, $user_id)
    {
       $groups = Group::all();
       $user   = User::find($user_id);
     
       return view('admin.user_edit', compact('groups','user'));
    }
    
    public function CategoryDelete(Request $request, $category_id)
    {
        
       
        $category = DB::table('category')->where('category_id', '=', $category_id)->get()[0];
        if($category->image)
        {
            $image_path = $_SERVER['DOCUMENT_ROOT'].'/warehouse_admin/public/uploads/category/thumbnail/'.$category->image;
            @unlink($image_path);
            $image_path = $_SERVER['DOCUMENT_ROOT'].'/warehouse_admin/public/uploads/category/'.$category->image;
            @unlink($image_path);
        }
        $delete = DB::table('category')->where('category_id', '=', $category_id)->delete();
            
            if($delete)
                return redirect('admin/category_list')->with('success', 'Your category has been deleted successfully');
            else
               return redirect('admin/category_list')->with('success', 'Your category has not been deleted');
    }
    
    public function GroupDelete(Request $request, $group_id)
    {
        DB::table('users')->where('group_id', '=', $group_id)->delete();
        
        $delete = DB::table('groups')->where('id', '=', $group_id)->delete();
            
        if($delete)
           return redirect('admin/group_list')->with('success', 'The group has been deleted successfully');
        else
          return redirect('admin/group_list')->with('success', 'The group has not been deleted');
    }
    
    public function UserDelete(Request $request, $user_id)
    {
       
        $delete = DB::table('users')->where('id', '=', $user_id)->delete();
            
        if($delete)
           return redirect('admin/user_list')->with('success', 'The user has been deleted successfully');
        else
          return redirect('admin/user_list')->with('success', 'The user has not been deleted');
    }
    
    public function WareHouseDelete(Request $request, $user_id)
    {
       
        $delete = DB::table('warehouses')->where('id', '=', $user_id)->delete();
            
        if($delete)
           return redirect('admin/warehouse_list')->with('success', 'The warehouse has been deleted successfully');
        else
          return redirect('admin/warehouse_list')->with('success', 'The warehouse has not been deleted');
    }
    
    public function WareHosueUserDelete(Request $request, $user_id)
    {
       
        $delete = DB::table('users')->where('id', '=', $user_id)->delete();
            
        if($delete)
           return redirect('admin/warehouse_user_list')->with('success', 'The warehouse user has been deleted successfully');
        else
          return redirect('admin/warehouse_user_list')->with('success', 'The warehouse user has not been deleted');
    }
    
    public function NewProduct(Request $request)
    {
       $admin_id =  Auth::guard('admin')->id(); 
       $category = DB::table('category')->where([['parent_id', '=', 0],])->orderBy('name', 'ASC')->get();
       
       return view('admin.add_product', ['category' => $category]);
    }
    
    public function PostProduct(Request $request)
    {
       $name = $request->input('name');
       $category = $request->input('category');
       $sub_category = $request->input('sub_category');
       $sub_category_2 = $request->input('second_sub_category');
       $price = $request->input('price');
       $description = $request->input('description');
       
       $admin_id =  Auth::guard('admin')->id(); 
       
       $insert  = DB::insert('insert into products (name,category_id,sub_category_id,sub_category_id_2,price,description) values (?, ?, ?,? ,? ,? )', 
                  [$name, $category,$sub_category,$sub_category_2,$price,$description]);
       $id = DB::getPdo()->lastInsertId(); 
       if($id)
        {
            $file = $request->file('file');
            if(count($file) > 0)
            {
            for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
                $image = $file[$i];
                $input['imagename'] = time().rand().'.'.$image->getClientOriginalExtension();
                
                $destinationPath = public_path('/uploads/product/thumbnail');
                $destinationPath1 = public_path('/uploads/product');
                
                $img = Image::make($image->getRealPath());
                $img->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$input['imagename']);
                $img->resize(800, 800, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath1.'/'.$input['imagename']);
                

                $imageName = $input['imagename'];
                
               DB::insert('insert into product_images (product_id,image) values (?, ?)', [$id,$imageName]);
            }
        }
        }
        
        if($id)
          return redirect('admin/product_list')->with('success', 'Your product has been uploaded successfully');
        else
            return redirect('admin/product_list')->with('success', 'Your product has not been uploaded');
    }
    
    public function ProductList()
    {
         $admin_id =  Auth::guard('admin')->id();
         
       
             $products = DB::select("SELECT products.*, `category`.`name` as `category_name` FROM `products` "
                    . "INNER JOIN `category` ON(`products`.`category_id` = `category`.`category_id`) ");

	 return view('admin.products', ['products' => $products]);
    }
    
    public function ProductDelete(Request $request, $product_id)
    {
        
        $product_image = DB::table('product_images')->where('product_id', '=', $product_id)->get();
     
        if(count($product_image)>0){
            foreach($product_image as $key=>$image)
            {

               $image_path = $_SERVER['DOCUMENT_ROOT'].'/warehouse_admin/public/uploads/product/thumbnail/'.$image->image;
               @unlink($image_path);
               $image_path = $_SERVER['DOCUMENT_ROOT'].'/warehouse_admin/public/uploads/product/'.$image->image;
               @unlink($image_path);
            }
            DB::table('product_images')->where('product_id', '=', $product_id)->delete();
            
        }
        
        $delete = DB::table('products')->where('id', '=', $product_id)->delete();
            
            if($delete)
                return redirect('admin/product_list')->with('success', 'Your product has been deleted successfully');
            else
               return redirect('admin/product_list')->with('success', 'Your product has not been deleted');
    }
    
    public function ProductEdit(Request $request,  $product_id)
    {
        $admin_id =  Auth::guard('admin')->id();
         
         // get all stores of logged in vendor
        $products = DB::select("SELECT products.*, `category`.`name` as `category_name` FROM `products` "
                 . "INNER JOIN `category` ON(`products`.`category_id` = `category`.`category_id`) "
                . "WHERE `products`.`id`=$product_id");
        
        
        $product_image = DB::table('product_images')->where('product_id', '=', $product_id)->get();
        $category = DB::table('category')->where('parent_id', '=', 0)->orderBy('name', 'ASC')->get();
        $sub_category = DB::table('category')->where('parent_id', '=', $products[0]->category_id)->orderBy('name', 'ASC')->get();
        $sub_category_2 = DB::table('category')->where('parent_id', '=', $products[0]->sub_category_id)->orderBy('name', 'ASC')->get();
        
      
        return view('admin.product_edit', ['product_image' => $product_image,'product' => $products[0],'category' => $category, 'sub_category'=>$sub_category,'sub_category_2'=>$sub_category_2]);
    }
    
    public function PostEditProduct(Request $request)
    {
       $name = $request->input('name');
       $category = $request->input('category');
       $sub_category = $request->input('sub_category');
       $sub_category_2 = $request->input('second_sub_category',0);
       $price = $request->input('price');
       $description = $request->input('description');
       
       $admin_id =  Auth::guard('admin')->id(); 
       $product_id = $request->input('product_id');
       $product = Product::find($product_id);
       $product->name = $name;
       $product->category_id = $category;
       $product->sub_category_id = $sub_category;
       $product->sub_category_id_2 = $sub_category_2;
       $product->price = $price;
       $product->description = $description;
       $update = $product->save();
       
       $file = $request->file('file');   
       if($request->has('file'))
       {
        if(count($file) > 0){
        {
            

            for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
                $image = $file[$i];
                $input['imagename'] = time().rand().'.'.$image->getClientOriginalExtension();
                
                $destinationPath = public_path('/uploads/product/thumbnail');
                $destinationPath1 = public_path('/uploads/product');
                
                $img = Image::make($image->getRealPath());
                $img->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$input['imagename']);
                $img->resize(800, 800, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath1.'/'.$input['imagename']);
                
                $imageName = $input['imagename'];
                
               DB::insert('insert into product_images (product_id,image) values (?,  ?)', [$product_id,$imageName]);
            }}
        }
       }
        if($update)
          return redirect('admin/product_list')->with('success', 'Your product has been updated successfully');
        else
            return redirect('admin/product_list')->with('success', 'Your product has not been updated');
    }
    
    public function DeleteProducImage(Request $request)
    {
      $product_id = $request->product_id;
     
        $image_id = $request->image_id;
        $product_image = DB::table('product_images')->where('id', '=', $image_id)->get();
     
        if(count($product_image)>0){
            foreach($product_image as $key=>$image)
            {

              $image_path = $_SERVER['DOCUMENT_ROOT'].'/warehouse_admin/public/uploads/product/thumbnail/'.$image->image;
              $image_path1 = $_SERVER['DOCUMENT_ROOT'].'/warehouse_admin/public/uploads/product/'.$image->image;
              @unlink($image_path);
              @unlink($image_path1);
            }
            DB::table('product_images')->where('id', '=', $image_id)->delete();
           echo 1;
        }
    }
    
}

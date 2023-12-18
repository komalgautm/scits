<?php
namespace App\Http\Controllers\backEnd;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Category, App\HomeCategory, App\LogBook;
use Session,DB;

class HomeCategoriesController extends Controller
{
	public function index(Request $request)
    {   
        $home_id = Session::get('scitsAdminSession')->home_id;
       	
        if(empty($home_id)) {
            return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
        }

        $categorys = Category::with('renamed')->orderBy('name','asc')->get()->toArray();

        $limit = 10;
       	$search  = 10;
       	
        $page = 'categories';
        return view('backEnd/category/categories', compact('page','limit','categorys','search')); 
    }

    public function view($category_id = null){


    	$home_id = Session::get('scitsAdminSession')->home_id;

        $category = Category::with('renamed')->where('id', $category_id)->first();

        if(!empty($category)) {
            $category = $category->toArray();
        }

        $page = 'category';
        return view('backEnd/category/category_form', compact('page','category'));    
    }
    

    public function edit(Request $request){

        $data = $request->input();
        if(!empty($data)){
        
            $home_id    = Session::get('scitsAdminSession')->home_id;
            $category_id   = $data['category_id'];
            $category_name = $data['category_name'];
            $category_icon = $data['category_icon'];
            $category_color = $data['category_color'];
            
            $category = HomeCategory::where('category_id',$category_id)->where('home_id',$home_id)->first();
            $category_tabel = Category::where('id',$category->category_id)->first();
            
            if(!empty($category)){
                $category->name     = $category_name;
                $category->icon     = $category_icon;
                $category_tabel->name     = $category_name;
                $category_tabel->icon     = $category_icon;
                $category_tabel->color     = $category_color;
        
            } else{
        
                $category           = new HomeCategory;
                $category->name     = $category_name;
                $category->icon     = $category_icon;
                $category->category_id = $category_id;
                $category->home_id  = $home_id;

                $category_table           = new Category;
                $category_table->name     = $category_name;
                $category_table->icon     = $category_icon;
                $category_tabel->color     = $category_color;
            }
        
            if($category->save() && $category_tabel->save()){
                $log_book_table = LogBook::select('log_book.category_id', 'log_book.category_name', 'log_book.category_icon')
                                    ->where('log_book.category_id', $category_tabel->id)
                                    ->update(['log_book.category_name' => $category_tabel->name,'log_book.category_icon' => $category_tabel->icon]);
                return redirect('/admin/categories')->with('success','Category successfully updated.');
            } else{
                return redirect('/admin/categories')->with('error',COMMON_ERROR);
            }
        }
    }

    public function add(Request $request){

        if($request->isMethod('post')) {
            $home_id    = Session::get('scitsAdminSession')->home_id;
            // $category_id   = $data['category_id'];
            $category_name = $request->category_name;
            $category_icon = $request->category_icon;
            $category_tag = $request->category_tag;
            $category_tag = $request->category_color;

            $category = new Category();
            $category->name = $category_name;
            $category->icon = $category_icon;
            $category->tag = $category_tag;

            $category->save();
            $category_id = $category->id;

            $home_category = new HomeCategory();
            $home_category->home_id = $home_id;
            $home_category->name = $category_name;
            $home_category->icon = $category_icon;
            $home_category->category_id = $category_id;

            
            if($home_category->save()){
                return redirect('/admin/categories')->with('success','Category successfully updated.');
            } else{
                return redirect('/admin/categories')->with('error',COMMON_ERROR);
            }
        }
        $page = 'category';
        return view('backEnd/category/category_add_form', compact('page'));
    }
}

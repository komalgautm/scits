<?php
namespace App\Http\Controllers\backEnd\superAdmin;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ServiceUser, App\FileManagerCategory;  
use DB;
use Session; 

class FileManagerCategoryController extends Controller { 
    
    public function index(Request $request) { 
        //echo "1"; die;
        // $home_id = Session::get('scitsAdminSession')->home_id;
        
        // if(!empty($home_id)) {

            $file_category_name = FileManagerCategory::select('id','name')->where('is_deleted','0');
            // echo "<pre>"; print_r($file_category_name); die;
            $search = '';

            if(isset($request->limit)) {
                $limit = $request->limit;
                Session::put('page_record_limit',$limit);
            } else {
                if(Session::has('page_record_limit')) {

                    $limit = Session::get('page_record_limit');
                } else {
                    $limit = 25;
                }
            }
            if(isset($request->search)) {
                $search                  = trim($request->search);
                $file_category_name      = $file_category_name->where('name','like','%'.$search.'%');
            }

            $file_category_name = $file_category_name->paginate($limit);
            // echo "<pre>"; print_r($file_category_name); die;
        // } else {
        //     return redirect('admin/')->with('error',UNAUTHORIZE_ERR);
        // }    
        
        $page = 'file_category_name';
        return view('backEnd/superAdmin/file_category/file_categories', compact('page', 'limit','file_category_name', 'search')); 
    }

    public function add(Request $request) {     

        if($request->isMethod('post')) {   

            $category           =  new FileManagerCategory;
            $category->name    =  $request->name;
           
            if($category->save())  {           
                return redirect('super-admin/filemanager-categories')->with('success', 'FileManager Category added successfully.');
            }else {
                return redirect()->back()->with('error', 'Error occurred, Try after sometime.');
            }
        }
        $page = 'file_category_name';
        return view('backEnd/superAdmin/file_category/file_category_form', compact('page', 'page'));
    }

    public function edit(Request $request, $category_id) { 	  
     
        $category  = FileManagerCategory::find($category_id);

            if($request->isMethod('post')) {   
                $category->name  =  $request->name;
                
                if($category->save()) {   
                   
                   return redirect('super-admin/filemanager-categories')->with('success','FileManager Category updated successfully.'); 
                }  else   {
                   
                   return redirect()->back()->with('error', 'Error occurred, Try after sometime.'); 
                }  
            }

        $page = 'file_category_name';
        return view('backEnd/superAdmin/file_category/file_category_form', compact('category', 'page'));
    }

    public function delete($category_id) {  
        
        if(!empty($category_id)) {
            
            $updated = FileManagerCategory::where('id', $category_id)->update(['is_deleted'=>'1']);
            if($updated) {

                return redirect()->back()->with('success','FileManager Category  deleted Successfully.');
            }  else {

                return redirect()->back()->with('error', 'Some Error Occured, Try After Sometime');
            } 
        
        } else {
            return redirect('admin/')->with('error','Sorry, FileManager Category  does not exist'); 
        }
    }
}
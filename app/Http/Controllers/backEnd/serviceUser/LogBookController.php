<?php
namespace App\Http\Controllers\backEnd\serviceUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Home, App\Admin, App\LogBook, App\ServiceUser, App\ServiceUserLogBook, App\CategoryFrontEnd;
use DB, Session;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class LogBookController extends Controller
{
    public function index($service_user_id, Request $request) {   

        $su_log_book_records =  ServiceUserLogBook::select('su_log_book.id as su_log_book_id','log_book.title','log_book.details','log_book.id','log_book.date','log_book.created_at','u.name as staff_name', 'log_book.category_name')
                                    ->join('log_book','log_book.id','su_log_book.log_book_id')
                                    ->leftJoin('user as u','u.id','log_book.user_id')
                                    ->where('su_log_book.service_user_id', $service_user_id)
                                    ->orderBy('su_log_book.id','desc');
                                    // ->get()->toArray();
        // echo "<pre>"; print_r($su_log_book_records); die;
        
        $search = '';
        $date_value = '';
        $given_date = '';

        if(isset($request->limit)) {
            $limit = $request->limit;
            Session::put('page_record_limit',$limit);
        } else{

            if(Session::has('page_record_limit')){
                $limit = Session::get('page_record_limit');
            } else{
                $limit = 10;
            }
        }    

        if(isset($request->search)) {
            
            $search = trim($request->search);
            // echo $search; die;
            $su_log_book_records = $su_log_book_records->where('log_book.title','like','%'.$search.'%');             //search by date or title
        }  

        if(isset($request->category_id)) {
            $category_val = trim($request->category_id);
            $su_log_book_records = $su_log_book_records
            ->where('log_book.category_id', $category_val);
        }


        if(isset($request->start_date) and isset($request->end_date)) {
            $start_date = trim($request->start_date);
            $end_date = trim($request->end_date);
            $su_log_book_records = $su_log_book_records
            ->whereDate('log_book.created_at','>=', $start_date)
            ->whereDate('log_book.created_at', '<=', $end_date);
        } 
        else if(isset($request->start_date)) {
            $start_date = trim($request->start_date);
            $su_log_book_records = $su_log_book_records->whereDate('log_book.created_at', '>=' , $start_date);
        } 
        else if(isset($request->end_date)) {
            $end_date = trim($request->end_date);
            $su_log_book_records = $su_log_book_records->whereDate('log_book.created_at','<=', $end_date);
        } 

        $su_log_book_records = $su_log_book_records->paginate($limit);                      

        $categorys = CategoryFrontEnd::select('category.*')->orderBy('name','asc')->get()->toArray();

        /**
         * Removing Attendance Category
         */
        foreach($categorys as $k => $val) {
            if($val['name'] == "Attendance") {
                unset($categorys[$k]);
            }
        }
        
        $page = 'service-users-log-book';
        
        return view('backEnd.serviceUser.logBook.logbook', compact('page','limit', 'service_user_id','su_log_book_records','search', 'date_value', 'categorys')); 
    }

    public function view($log_book_id = null) {
        
        $log_info = LogBook::select('log_book.id', 'log_book.title','log_book.details','log_book.date','u.name','su_lb.service_user_id')
                            ->join('su_log_book as su_lb', 'su_lb.log_book_id', 'log_book.id')
                            ->join('user as u','u.id','su_lb.user_id')
                            ->where('log_book.id', $log_book_id)
                            ->first();

        // echo "<pre>"; print_r($log_info); die;

         $page = 'service-users-log-book';
         return view('backEnd.serviceUser.logBook.logbook_form', compact('page','log_info'));

    }
    public function pdfDownload($logBooks, $image_id)
    {
        $data = array(
            'logBooks' => $logBooks,
            'image_id' => $image_id,
        );
        // view()->share('logBooks',$logBooks);
        view()->share('data',$data);

        $pdf = PDF::loadView('pdf.logbook')->setPaper('a4', 'landscape');
        return $pdf->stream('logBooks.pdf');
    }

    public function csvDownload($logBooks)
    {
        $fileName = 'logbook.csv';
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        $columns = array('Id', 'Staff Name', 'Category', 'Title', 'Details', 'Date', 'Late');
        if(isset($logBooks[0]->service_user_name)) {
            $columns[] = 'Service User';
        }

        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);

        foreach ($logBooks as $logBook) {
            $data = [$logBook->id, $logBook->staff_name, $logBook->category_name, $logBook->title, $logBook->details, $logBook->date, $logBook->is_late ? "Yes" : "No"];
            if(isset($logBook->service_user_name)) {
                $data[] = $logBook->service_user_name;
            }
            fputcsv($file, $data);
        }
        fclose($file);
        return response('', 200, $headers);
    }

    public function download(Request $request)
    {
        $home_id = ServiceUser::where('id', $request->get('service_user_id'))->value('home_id');
        $admin_id = Home::where('id', $home_id)->value('admin_id');
        $image_id = Admin::where('id', $admin_id)->value('image');

        $query = DB::table('log_book')
            ->select(
                'log_book.id', 'log_book.title', 'log_book.category_name', 'log_book.date', 'log_book.details','log_book.created_at', 'log_book.is_late',
                'user.name as staff_name'
            )
            ->join('user', 'log_book.user_id', '=', 'user.id')
            ->orderBy('log_book.id', 'ASC');

        
        if(isset($request->category_id)  && $request->category_id!='NaN') {
            $query = $query->where('log_book.category_id', $request->get('category_id'));
            Log::info($request->get('category_id'));
            // Log::info($query->get()->toArray());
        }

        if(isset($request->start) && $request->start!='null') {
            $query = $query->whereDate('log_book.created_at', '>=', $request->get('start'));
            Log::info($request->get('start'));
            Log::info($query->get()->toArray());
        }
        if(isset($request->end) && $request->end!='null') {
            // Log::info($request->get('end'));
            // Log::info($query->get()->toArray());
            $query = $query->whereDate('log_book.created_at', '<=', $request->get('end'));
        }

        if($request->get('service_user_id')) {
            $query
                ->addSelect('service_user.name as service_user_name')
                ->join('su_log_book', 'log_book.id', '=', 'su_log_book.log_book_id')
                ->join('service_user', 'service_user.id', '=', 'su_log_book.service_user_id')
                ->where('su_log_book.service_user_id', '=', $request->get('service_user_id'));
        }

        
        
        
        $logBooks = $query->get()->map(function ($item) {
            // $created_at = Carbon::parse($item->created_at);
            $date = Carbon::parse($item->date);
            // $item->created_at = $created_at->format('d-m-Y');
            $item->date = $date->format('d-m-y H:i');
            // $item->diffInHours = $created_at->diffInHours($date);
            // dd($item);
            // if($item->is_late==1)
            //     $item->is_late = 'Yes';
            // else
            // $item->is_late = 'No';
            return $item;
        });


        switch ($request->get('format')){
            case "csv":
                return $this->csvDownload($logBooks);
                break;
            case "pdf":
                return $this->pdfDownload($logBooks, $image_id);
                break;
            default:
                return response()->json($logBooks);
                break;
        }
    }

}
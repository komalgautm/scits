<?php

namespace App\Http\Controllers\frontEnd\ServiceUserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Session;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\Home;
use App\Models\Admin;
use App\Models\LogBook;
use App\Models\ServiceUser;
use App\Models\ServiceUserLogBook;
use App\Models\CategoryFrontEnd;

class PDFLogsController extends Controller
{
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
            $query = $query->whereDate('log_book.date', '>=', $request->get('start'));
            Log::info($request->get('start'));
            Log::info($query->get()->toArray());
        }
        if(isset($request->end) && $request->end!='null') {
            // Log::info($request->get('end'));
            // Log::info($query->get()->toArray());
            $query = $query->whereDate('log_book.date', '<=', $request->get('end'));
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
}

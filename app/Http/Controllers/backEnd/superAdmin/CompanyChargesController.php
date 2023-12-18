<?php
namespace App\Http\Controllers\backEnd\superAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CompanyCharges;
use Session;

class CompanyChargesController extends Controller
{
	public function index(Request $request){

		$company_charges = CompanyCharges::select('company_charges.*');
		// echo "<pre>"; print_r($company_charges); die;
		$search = '';

        if(isset($request->limit)) {
            $limit = $request->limit;
            Session::put('page_record_limit',$limit);
        } else{
            if(Session::has('page_record_limit')){
                $limit = Session::get('page_record_limit');
            } else{
                $limit = 20;
            }
        }

        if(isset($request->search)) {
            $search 			= trim($request->search);
            $company_charges 	= $company_charges->where('home_range','like','%'.$search.'%');
        }

        $company_charges = $company_charges->paginate($limit);

		$page = 'company_charges';
		return View('backEnd.superAdmin.company_charges.index',compact('page','company_charges','search','limit'));
	}

	public function edit(Request $request,$package_id = Null){

		$company_charge = CompanyCharges::select('company_charges.*')
										->where('id',$package_id)
										->get()->toArray();
		$home_range 	= explode('-', $company_charge['0']['home_range']);
		$start_range 	= $home_range['0'];
		$end_range 		= $home_range['1'];

		if($package_id > '1'){
			$previous_range 		= CompanyCharges::where('id',$package_id-1)
													->value('home_range');
			$previous_range_arr		= explode('-', $previous_range);
			
			$previous_start_range 	= $previous_range_arr['0'];
			$previous_end_range 	= $previous_range_arr['1'];
			if($package_id < '4'){
				$next_range 			= CompanyCharges::where('id',$package_id+1)
														->value('home_range');
				$next_range_arr			= explode('-', $next_range);
				$next_start_range 		= $next_range_arr['0'];
				$next_end_range 		= $next_range_arr['1'];
			}else{
				$next_start_range 		= '';
				$next_end_range 		= '';
			}
		}else{
			$previous_range 		= '';
			$previous_start_range 	= '';
			$previous_end_range 	= '';
			$next_start_range 		= '';
			$next_end_range 		= '';
		}

		if($request->end_range >= $next_start_range && $package_id > '1' && $package_id < '4'){
			return redirect('admin/company-charge/edit/'.$package_id)->with('error','Range End overlaps with the next range.');
		}

		if($request->isMethod('post')){
			// echo "<pre>"; print_r($request->input()); die;
			$admin_id 		= Session::get('scitsAdminSession')->id;
			$start_range 	= $request->start_range;
			$end_range 		= $request->end_range;
			$range 			= $start_range.'-'.$end_range;

			$update_company_charge = CompanyCharges::where('id',$package_id)
													->update([
															'super_admin_id' 	=> $admin_id,
															'home_range' 		=> $range,
															'price_monthly'		=> !empty($request->price_monthly)? $request->price_monthly : '0',
															'price_yearly'		=> !empty($request->price_yearly)? $request->price_yearly: '0',
															'days' 				=> !empty($request->days)? $request->days : '0'
														]);
			if($update_company_charge){
				return redirect('admin/company-charges')->with('success','Company charges updated successfully.');
			}
		}

		$page = 'company_charges';
		return View('backEnd.superAdmin.company_charges.form',compact('page','company_charge','start_range','end_range','previous_range'));
	}

	public function validate_home_range(Request $request){
		// echo "<pre>"; print_r($request->input()); die;
		$previous_range = $request->previous_range;
		if($previous_range != '' && $request->package_type != 'Silver'){
			$previous_range		= explode('-', $previous_range);
			$previous_end_range = $previous_range['1'];

			if($request->start_range > $previous_end_range){
	            $r['valid'] = true;
	            echo json_encode($r);
	        } else{
	            $r['valid'] = false;
	            echo json_encode($r);
	        } die;
		}else{
			$r['valid'] = true;
	        echo json_encode($r);
		}
	}

	public function validate_range_gap(Request $request){

		if($request->end_range > $request->start_range){
	        $r['valid'] = true;
	        echo json_encode($r);
        } else{
            $r['valid'] = false;
            echo json_encode($r);
        } die;
	}
}

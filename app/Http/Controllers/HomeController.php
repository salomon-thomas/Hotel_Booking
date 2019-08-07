<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Carbon\Carbon;
Use App\bookings;
use Alert;
Use Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function select_date(Request $request)
    {
        if ($request->isMethod('post')) 
        {
            $post_data=$request->all();
            $date=Carbon::parse($post_data['date'])->format('Y/m/d');
            $booking=bookings::select()->where('date',$date)->get();
            $booking=collect($booking)->sortBy('room_no')->toArray();
            // dd($booking);
            return view('make_booking',['jmax'=>0,'j'=>1,'booking'=>$booking,'date'=>$date]);
        }
        else
        {
            return view('select_date');
        }
    }
    public function make_booking(Request $request)
    {
        if ($request->isMethod('post')) 
        {
            $post_data=$request->all();
            unset($post_data['_token']);
            $date=$post_data['date'];
            unset($post_data['date']);
            $id=array();
            if(empty($post_data))
            {
                Alert::error('Select a room to make booking', 'Opps!!');
                return back();
            }
            foreach ($post_data as $key => $value) 
            {
                $data= array();
                $data['room_no']=$key;
                $data['user_id']=Auth::User()->id;
                $data['date']=$date;
                $id[$key]=bookings::insertGetId($data);
            }
            if(!empty($id))
            {
                Alert::success('Booking Process Completed', 'Great!');
                return redirect()->route('select_date');
            }
            else
            {
                Alert::error('failed to make a booking', 'Opps!!');
                return back();
            }
        }

    }
    public function my_booking(Request $request)
    {
        if ($request->isMethod('post')) 
        {

        }
        else
        {
            $user_id=Auth::User()->id;
            $date=Carbon::now()->format('Y/m/d');
            $data=bookings::select('id','date','room_no')->where('user_id',$user_id)->orderBy('date','ASC')->get();
            $data=collect($data)->toArray();
            $distance=array();
            foreach ($data as $key => $row) {
                $distance[$key] = $row['room_no'];
            }
            array_multisort($distance, SORT_ASC, $data);
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($data);
            $perPage = 5;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
            $data= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
            $data->setPath(url()->route('my_booking'));
            return view('my_booking',['data'=>$data,'i'=>0]);
        }
    }
    function delete_booking($id)
    {
        bookings::where('id', $id)->delete();
        return redirect()->route('my_booking');

    }
}

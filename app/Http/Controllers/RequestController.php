<?php

namespace App\Http\Controllers;

use App\RequestOffer;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Facades\App\Repository\Contracts\ControllerRepository as Repo;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function creatorRequests(Request $request)
    {
        $getCreatorCats = Auth::user()->categories;
        $requests = [];
        $requestsIds = [];
        $getCreatorBids = RequestOffer::where('user_id', Auth::user()->id)->get(['request_id']);

        $creatorBidsIds = array_flatten($getCreatorBids->toArray());

        if (count($request->all()) > 0){
            if ($request->status == config('studentbox.request-status.doing')){
                foreach ($getCreatorCats as $cat){
                    if (count($cat->contents()->with(['request'])->has('request')
                            ->where('status', config('studentbox.content-status.doing'))->get()) > 0){
                        foreach ($cat->contents()->with(['request'])->has('request')
                                     ->where('status', config('studentbox.content-status.doing'))->get() as $content){
                                if ($content->request->status == config('studentbox.request-status.doing' )
                                    && Carbon::parse($content->request->due_date)->gte(Carbon::today())){
                                    array_push($requests, $content->request);
                                    array_push($requestsIds, $content->request->id);
                                }
                        }
                    }
                }
            }

            if ($request->status == config('studentbox.request-status.completed')){
                foreach ($getCreatorCats as $cat){
                    if (count($cat->contents()->with(['request'])->has('request')
                            ->where('status', config('studentbox.content-status.completed'))->get()) > 0){
                        foreach ($cat->contents()->with(['request'])->has('request')
                                     ->where('status', config('studentbox.content-status.completed'))->get() as $content){
                            if ($content->request->status == config('studentbox.request-status.completed' )
                                && Carbon::parse($content->request->due_date)->gte(Carbon::today())){
                                array_push($requests, $content->request);
                                array_push($requestsIds, $content->request->id);
                            }
                        }
                    }
                }
            }
        }
        else{
            foreach ($getCreatorCats as $cat){
                if (count($cat->contents()->with(['request'])->has('request')
                        ->where('status', config('studentbox.content-status.requested'))->get()) > 0){
                    foreach ($cat->contents()->with(['request'])->has('request')
                                 ->where('status', config('studentbox.content-status.requested'))->get() as $content){

                        if (!in_array($content->request->id, $creatorBidsIds)){

                            if ($content->request->status == config('studentbox.request-status.requested-pending-payment' )
                                && Carbon::parse($content->request->due_date)->gte(Carbon::today())){

                                array_push($requests, $content->request);
                                array_push($requestsIds, $content->request->id);
                            }
                        }
                    }
                }
            }
        }

        return view('creator.requests.requests')
            ->withItems($requests);

    }

    public function myRequests(Request $request)
    {
        $title = null;

        if (count($request->all()) > 0){
            $items = Repo::getModel('App\Request')->findBy('status', $request->status);
            $title = $request->status == 'paid' ? 'Pending' : $request->status ;
        }
        else{
            $items = Repo::getModel('App\Request')->all();
        }

        return view('frontend.orders.index')
            ->withTitle($title)
            ->withItems($items);
    }

    public function viewRequest($request_id)
    {
        return view('creator.requests.show')
            ->withItem(Repo::getModel('App\Request')->find($request_id));
    }

    public function viewOrder($request_id)
    {
        return view('frontend.orders.show-order')
            ->withItem(Repo::getModel('App\Request')->find($request_id));
    }

    public function orderBids($orderId)
    {
        $order = Repo::getModel('App\Request')->find($orderId);

        return view('frontend.orders.bids')
            ->withOrder($order)
            ->withBids($order->bids);
    }

    public function updateUserRequestStatus($request_id, $status)
    {
        $request = Repo::getModel('App\Request')->find($request_id);
        $request->status = $status;
        $request->save();

        return $request;
    }

    public function updateUserContentStatus($content_id, $status)
    {
        $content = Repo::getModel('App\Content')->find($content_id);
        $content->status = $status;
        $content->save();

        return $content;
    }
}

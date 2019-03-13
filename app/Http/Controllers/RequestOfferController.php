<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facades\App\Repository\Contracts\ControllerRepository as Repo;
use Illuminate\Support\Facades\Auth;

class RequestOfferController extends Controller
{
    protected $model = 'App\RequestOffer';

    public function placeBid($req_id, Request $request)
    {
        Repo::getModel($this->model)->create([
            'request_id' => $req_id,
            'offer' => $request->amount,
            'user_id' => Auth::user()->id,
            'reason' => $request->reason,
            'is_deleted' => false,
            'status' => config('studentbox.request-offer-status.pending'),
        ]);

        $userReq = Repo::getModel('App\Request')->find($req_id);
        $userReq->status = config('studentbox.request-status.bid');
        $userReq->save();

        notify()->success("Bid send successfully","Bid");

        return redirect()->route('creator.requests', Auth::user()->id);
    }

    public function bidAccepted($offer_id)
    {
        $offer = Repo::getModel($this->model)->find($offer_id);
        $offer->status = config('studentbox.request-offer-status.accepted');
        $offer->save();

        (new RequestController())->updateUserRequestStatus($offer->request_id, config('studentbox.request-status.accepted'));

        notify()->success("Bid accepted successfully","Bid", "center");

        return back();
    }

    public function creatorBids(Request $request)
    {
        if (count($request->all()) > 0){
            $bids = app($this->model)->where('user_id', Auth::user()->id)->where('status', $request->status)->get();
        }
        else{
            $bids = app($this->model)->where('user_id', Auth::user()->id)->get();
        }

        return view('creator.bids.index')
            ->withItems($bids);
    }

    public function creatorBidAction(Request $request)
    {
        $request->validate([
            'status' => 'required',
            'offer_id' => 'required'
        ]);

        $offer = Repo::getModel($this->model)->find($request->offer_id);
        $offer->status = $request->status;
        $offer->save();

        if ($request->status == config('studentbox.request-offer-status.confirmed')){
            $reqController = new RequestController();
            $reqController->updateUserRequestStatus($offer->request_id, config('studentbox.request-status.doing'));
            $reqController->updateUserContentStatus($offer->request->content_id, config('studentbox.content-status.doing'));
        }

        notify()->success("Bid {$request->status} successfully","Bid", "center");

        return back();
    }
}

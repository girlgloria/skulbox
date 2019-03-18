<?php

namespace App\Http\Controllers;

use App\Category;
use App\Content;
use App\Report;
use App\Repository\Contracts\ContentRepository;
use App\User;
use App\UserDownload;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContentController extends Controller
{
    protected $controllerRepo;
    protected $model = 'App\Content';

    /**
     * CategoryController constructor.
     * @param $controllerRepo
     */
    public function __construct(ContentRepository $controllerRepo)
    {
        $this->controllerRepo = $controllerRepo;
    }
    /**
     * Undocumented function
     *
     * @return void
     */
    public function index()
    {
        return view('creator.content.index')
            ->withItems($this->controllerRepo->getModel($this->model)->all());
    }

    public function creatorResourcesIndex()
    {
        return view('creator.content.index')
            ->withItems($this->controllerRepo->getModel($this->model)->findBy('user_id', \auth()->user()->id));
    }

    public function create()
    {
        return view('creator.content.create')
            ->withCats($this->controllerRepo->getModel('App\Category')->all());
    }

    public function uploadContent()
    {
        return view('frontend.upload');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content_type' => 'required',
            'file' => 'required',
            'type' => 'required',
            'description' => 'required',
        ]);

        $resource = $this->controllerRepo->getModel($this->model)->create($this->prepareData($request));

        $resource->categories()->attach($request->categories);

        notify()->success("Resources uploaded successfully");

        if (Auth::user()->user_type == config('studentbox.user_type.normal')){
            return redirect('/');
        }

        return redirect()->route('resource.index');

    }

    public function view($content_id)
    {
        return view('creator.content.show')
            ->withItem($this->controllerRepo->getModel($this->model)->find($content_id));
    }

    public function edit($content_id)
    {
        $item = $this->controllerRepo->getModel($this->model)->find($content_id);

        $getCategoryIds = [];

        foreach ($item->categories as $cat){
            array_push($getCategoryIds, $cat->id);
        }

        return view('creator.content.edit')
            ->withItem($item)
            ->withCatids($getCategoryIds)
            ->withCats($this->controllerRepo->getModel(Category::class)->all());
    }

    public function update(Request $request, $content_id)
    {
        $request->validate([
            'title',
            'content_type',
            'description',
        ]);

        $content = $this->controllerRepo->getModel($this->model)->find($content_id);

        $content->categories()->detach();

        $this->controllerRepo->getModel($this->model)->update($content_id, $this->prepareData($request));

        if ($request->file != null){
            unlink(storage_path().'/app/'. $content->content_path);
        }

        $content->categories()->attach($request->categories);

        notify()->success("Update successfully");

        return redirect()->route('resource.index');
    }

    public function upload(Request $request)
    {
        return $this->controllerRepo->upload($request);
    }

//    Todo:add detailed description

    public function download(Content $content)
    {
        $content->number_of_download = ($content->number_of_download  + 1);
        $content->save();

        return response()->download(storage_path().'/app/'.$content->content_path);
    }

    public function downloadRequest(\App\Request $request)
    {
        return response()->download(storage_path().'/app/'.$request->doc_link);
    }

    public function show(Content $content)
    {
        $canDownload = count(UserDownload::where('user_id', \auth()->user()->id)->where('content_id', $content->id)->get()) > 0 ? true : false;
        return view('frontend.single-content')
            ->withCanDownload($canDownload)
            ->withContent($content);
    }


    public function explore(Request $request)
    {
        if (count($request->all()) > 0){
            $contents = $this->controllerRepo->getModel($this->model)->findBy('user_id', $request->creator)
                ->where('content_type', 'public');
        }
        else{
            $contents = $this->controllerRepo->getModel($this->model)->findBy('content_type', 'public');
        }

        return view('frontend.explore')
            ->withContents($contents);
    }

    public function purchase(Content $content, Request $request)
    {
        $user = Auth::user();

        $mobileNumber = $request->new_number;
        //Remove leading and trailling spaces
        $mobileNumber = trim($mobileNumber);

        //Replace 07 with 254
        if (substr($mobileNumber, 0, 2) == "07") {
            $mobileNumber = "254" . substr($mobileNumber, 1);
        }

        //Replace +254 with 254
        if (substr($mobileNumber, 0, 1) == "+") {
            $mobileNumber = substr($mobileNumber, 1);
        }

        $getFromSaf = (new TransactionController())->init([
            'customer_name' => $user->name,
            'phone_number' => $mobileNumber,
            'amount' => $content->cost,
            'reference' => time(),
            'description' => 'Payment for '. $content->title
        ]);

        $content->number_of_sales = ($content->number_of_sales + 1);
        $content->save();

        UserDownload::create([
            'user_id' => $user->id,
            'content_id' => $content->id
        ]);

        notify()->success("Payment submitted successfully");

        return back();
    }

    public function search(Request $request)
    {
        $content = new Content();
        $query = $content->newQuery();
        $contents = [];
        $result = [];

        if ($request->has('category')){
            $cats = Category::findOrFail($request->category)->contents;
            foreach ($cats as $cat){
                if ($cat->content_type == 'public')
                    array_push($result, $cat);
            }
        }

        if ($request->has('keyword')){
            $contents = $query->orWhere('title', '%like%', $request->keyword)
                ->orWhere('description', '%like%', $request->keyword);
        }

        if ($request->has('price')){
            if ($request->price == 'free'){
                $contents = $query->orWhere('cost', '<=', 0);
            }

            if ($request->price == 'paid'){
                $contents = $query->orWhere('cost', '>', 0);
            }
        }

        foreach ($contents->get() as $cat){
            if ($cat->content_type == 'public' && !in_array($result, $cat))
                array_push($result, $cat);
        }

        return view('frontend.explore')
            ->withContents($result);
    }

    public function creators()
    {
        return view('frontend.creators')
            ->withCreators($this->controllerRepo->getModel(User::class)->findBy('user_type', config('studentbox.user_type.agent')));
    }

    public function myResources(Request $request)
    {

        $user = \auth()->user();

        if ($user->user_type != config('studentbox.user_type.normal')){
            notify()->error("You dont have permission to view this page");

            return back();
        }

        if (count($request->all()) > 0){
            $contents = Content::where('is_deleted', false)->where('content_type', $request->type)
                ->where('user_id', $user->id)->get();
        }
        else{
            $contents = Content::where('is_deleted', false)->where('content_type', 'public')->where('user_id', $user->id)->get();
        }

        return view('frontend.explore')
            ->withUser($user)
            ->withContents($contents);

    }

    public function orderContent()
    {
        return view('frontend.request');
    }

    public function orderRequest(Request $request)
    {
//                dd($request->all());
        return view('frontend.confirm-order')
            ->withData($request->all());

    }

    public function delete($resource_id)
    {
        $this->controllerRepo->getModel($this->model)->delete($resource_id);

        notify()->success("Resource deleted successfully");

        return back();
    }

    public function orderPayment(Request $request)
    {
        $request->validate([
            'new_number' => 'required',
            'data' => 'required'
        ]);

        $data = json_decode($request->data, true);

        $content = $this->controllerRepo->getModel($this->model)->create([
            'user_id' => Auth::user()->id,
            'title' => $data['title'],
            'content_type' => 'private',
            'type' => $data['type'],
            'description' => $data['description'],
            'status' => config('studentbox.content-status.requested'),
            'cost' => $data['cost'],
        ]);

        $content->categories()->attach($data['category']);

        $request = $this->controllerRepo->getModel('App\Request')->create([
            'user_id' => Auth::user()->id,
            'doc_link' => isset($data['file']) ? $data['file'] : null,
            'content_id' => $content->id,
            'status' => config('studentbox.request-status.requested-paid'),
            'due_date' => Carbon::parse($data['due_date'])->toDateString(),
            'start_date' => Carbon::parse($data['start_date'])->toDateString(),
        ]);

        $mobileNumber = $request->new_number;
        //Remove leading and trailling spaces
        $mobileNumber = trim($mobileNumber);

        //Replace 07 with 254
        if (substr($mobileNumber, 0, 2) == "07") {
            $mobileNumber = "254" . substr($mobileNumber, 1);
        }

        //Replace +254 with 254
        if (substr($mobileNumber, 0, 1) == "+") {
            $mobileNumber = substr($mobileNumber, 1);
        }

        $getFromSaf = (new TransactionController())->init([
            'customer_name' => \auth()->user()->name,
            'phone_number' => $mobileNumber,
            'amount' => $content->cost,
            'reference' => time(),
            'description' => 'Payment for '. $content->title
        ]);

        notify()->success("Request send successfully");

        return redirect('/');
    }

    public function reportContent(Request $request)
    {
        $request->validate([
            'report' => 'required'
        ]);

        $this->controllerRepo->getModel(Report::class)->create([
            'user_id' => Auth::user()->id,
            'report' => $request->report,
            'content_id' => $request->content_id,
            'status' => config('studentbox.report-status.reported')
        ]);

        notify()->success("Report submitted successfully","Report","center");

        return back();
    }

    public function prepareData(Request $request)
    {
//        dd($request->all());
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        if ($request->file != null){
            $data['content_path'] = $request->file;
        }

        if ($request->image != null){
            $data['background_path'] = $this->controllerRepo->uploadImage($request->image, 270, 290);
        }

        return $data;
    }
}

<?php

namespace App\Http\Controllers;

use App\Content;
use App\Group;
use App\GroupResource;
use App\Repository\Contracts\ControllerRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    protected $model = 'App\Group';
    protected $controllerRepo;

    /**
     * GroupController constructor.
     * @param $controllerRepo
     */
    public function __construct(ControllerRepository $controllerRepo)
    {
        $this->controllerRepo = $controllerRepo;
    }


    public function index(Request $request)
    {
        dd('d');
    }

    public function viewGroup($group)
    {
        $group = Group::with(['users'])->where('name', $group)->get()->first();

        $getResources = array_flatten(GroupResource::where('group_id', $group->id)->get(['content_id'])->toArray());

        return view('frontend.group.group')
            ->withGroupResources(Content::whereIn('id', $getResources)->get())
            ->withIds($getResources)
            ->withResources($this->controllerRepo->getModel(Content::class)->findBy('user_id', Auth::user()->id))
            ->withGroup($group);
    }

    public function create()
    {
        return view('frontend.group.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        if (!$this->controllerRepo->getModel($this->model)->findBy('name', $request->name)){
            notify()->error("Group Already Exist");

            return back();
        }

        $group = $this->controllerRepo->getModel($this->model)->create([
            'name' => $request->name,
            'admin_id' => Auth::user()->id,
            'is_active' => true
        ]);

        Auth::user()->groups()->attach($group->id, ['is_admin' => true]);

        notify()->success("Group created successfully");

        return redirect('/');
    }

    public function share(Request $request)
    {
        $request->validate([
            'resource' => 'required',
            'group_id' => 'required',
        ]);

        $data = $request->all();

        foreach ($data['resource'] as $datum){
            if (count(GroupResource::where('content_id', $datum)->where('group_id', $request->group_id)->get()) < 1){
                $this->controllerRepo->getModel(GroupResource::class)->create([
                    'group_id' => $data['group_id'],
                    'shared_by' => Auth::user()->id,
                    'content_id' => $datum,
                    'is_active' => true
                ]);
            }
        }

        notify()->success("Resources shared successfully");

        return back();
    }

    public function myGroup()
    {
        return view('frontend.group.my-groups')
            ->withGroups(Auth::user()->groups);
    }
}

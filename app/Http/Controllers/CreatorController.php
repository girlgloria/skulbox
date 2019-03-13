<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreatorController extends Controller
{
    public function register()
    {
        return view('auth.register')
            ->withUserType(config('studentbox.user_type.agent'));
    }

    public function chooseCategories()
    {
        return view('auth.choose-cat')
            ->withCats(Category::where('is_deleted', false)->get());
    }

    public function storeChoices(Request $request)
    {
        $user = Auth::user();

        $user->categories()->attach($request->categories);

        return redirect('/');
    }
}

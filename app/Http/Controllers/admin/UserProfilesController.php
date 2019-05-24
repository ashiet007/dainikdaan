<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\UserProfile;
use Illuminate\Http\Request;

class UserProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 100;

        if (!empty($keyword)) {
            $userprofiles = UserProfile::select('user_profiles.*')->with('users')
                                            ->join('users', 'users.id', '=', 'user_profiles.user_id')
                                            ->where('users.name', 'LIKE', "%$keyword%")
                                            ->orWhere('users.username', 'LIKE', "%$keyword%")
                                            ->orWhere('mobile_no', 'LIKE', "%$keyword%")
                                            ->orWhere('alternate_mobile_no', 'LIKE', "%$keyword%")
                                            ->orWhere('district', 'LIKE', "%$keyword%")
                                            ->orWhere('state', 'LIKE', "%$keyword%")
                                            ->paginate($perPage);
        } else {
            $userprofiles = UserProfile::with('users')->paginate($perPage);
        }

        return view('admin.user-profiles.index', compact('userprofiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.user-profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        UserProfile::create($requestData);

        return redirect('admin/user-profiles')->with('flash_message', 'UserProfile added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $userprofile = UserProfile::with('users')->findOrFail($id);

        return view('admin.user-profiles.show', compact('userprofile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $userprofile = UserProfile::findOrFail($id);

        return view('admin.user-profiles.edit', compact('userprofile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $userprofile = UserProfile::findOrFail($id);
        $userprofile->update($requestData);

        return redirect('admin/user-profiles')->with('flash_message', 'UserProfile updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        UserProfile::destroy($id);

        return redirect('admin/user-profiles')->with('flash_message', 'UserProfile deleted!');
    }
}

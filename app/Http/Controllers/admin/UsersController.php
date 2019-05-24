<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use App\UserDetail;
use App\UserPassword;
use App\GetHelp;
use App\Bank;
use App\State;
use App\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function createUserForm(){
        $sponsorId = User::pluck('user_name','user_name')->toArray();
        $banks = Bank::pluck('name','id')->toArray();
        $states = State::all();
        $roles = Role::select('id', 'name', 'label')->get();
        $roles = $roles->pluck('label', 'name');
        return view('admin.users.fakeuser', compact('roles','sponsorId','banks','states'));
    }
    
    public function createUser(Request $request)
    {
        $this->validate($request, [
            'sponsor_id' => 'required|exists:users,user_name',
            'name' => ['required','string','max:255','regex:/(^[a-zA-Z\\s]*$)/u'],
            'user_name' => 'required|string|max:255|unique:users|alpha_num|regex:/^[a-zA-Z]{3}[A-Z0-9a-z]*$/',
            'role' => 'required',
            'identity' => 'required',
            'email' => 'required|string|email|max:255',
            'mob_no' => 'required|numeric|digits:10',
            'alternate_mob_no' => 'numeric|digits:10|nullable',
            'district_id' => 'required',
            'state_id' => 'required',
            'bank_id' => 'required',
            'account_no' => 'required|numeric',
            'account_type' => 'required|string|max:255',
            'ifsc_code' => ['required','string','max:255','regex:/(^([A-Z|a-z]{4}[0][A-Z0-9a-z]{6}$))/u'],
            'branch' => 'required|string|max:255',
            'paytm_no' => 'numeric|digits:10|nullable',
            'gpay_no' => 'numeric|digits:10|nullable',
            'password' => 'required|string|min:6|confirmed'
            ]);
        $password = $request->password;
        $data = $request->all();
        $user = User::create([
            'name' => strtoupper($request->name),
            'user_name' => strtolower($request->user_name),
            'email' => strtolower($request->email),
            'password' => bcrypt($request->password),
            'identity' => $request->identity,
            'sponsor_id' => $request->sponsor_id,
        ]);
        $user->assignRole($request->role);
        $userDetails = array();
        $userDetails['mob_no'] = $data['mob_no'];
        $userDetails['alternate_mob_no'] = $data['alternate_mob_no'];
        $userDetails['state_id'] = $data['state_id'];
        $userDetails['district_id'] = $data['district_id'];
        $userDetails['bank_id'] = $data['bank_id'];
        $userDetails['account_no'] = $data['account_no'];
        $userDetails['account_type'] = $data['account_type'];
        $userDetails['ifsc_code'] = strtoupper($data['ifsc_code']);
        $userDetails['branch'] = strtoupper($data['branch']);
        $userDetails['gpay_no'] = $data['gpay_no'];
        $userDetails['paytm_no'] = $data['paytm_no'];
        $userDetails = UserDetail::create($userDetails);
        $user->userDetails()->save($userDetails);
        UserPassword::create([
            'user_id' => $user->id,
            'password'=> $data['password']
        ]);
        return redirect('admin/users')->with('flash_message', 'User added!');
    } 

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 100;

        if (!empty($keyword)) {
            $users = User::select('users.*')->with('userDetails','userPassword')
                         ->join('user_details', 'user_details.user_id', '=', 'users.id')
                         ->where('name', 'LIKE', "%$keyword%")
                         ->orWhere('user_name', 'LIKE', "%$keyword%")
                         ->orWhere('status', 'LIKE', "%$keyword%")
                         ->orWhere('identity', 'LIKE', "%$keyword%")
                         ->orWhere('email', 'LIKE', "%$keyword%")
                         ->orWhere('user_details.mob_no','LIKE',"%$keyword%")
                         ->orWhere('user_details.alternate_mob_no','LIKE',"%$keyword%")
                         ->orWhere('user_details.state_id','LIKE',"%$keyword%")
                         ->orWhere('user_details.district_id','LIKE',"%$keyword%")
                         ->orderBy('created_at','DESC')
                ->paginate($perPage);
        } else {
            $users = User::with('userDetails.userState','userDetails.userDistrict','userPassword')->orderBy('created_at','DESC')->paginate($perPage);
        }
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        $roles = Role::select('id', 'name', 'label')->get();
        $roles = $roles->pluck('label', 'name');

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required', 'email' => 'required', 'password' => 'required', 'roles' => 'required']);

        $data = $request->except('password');
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);

        foreach ($request->roles as $role) {
            $user->assignRole($role);
        }

        return redirect('admin/users')->with('flash_message', 'User added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function show($id)
    {
        $user = User::with('userDetails.userState','userDetails.userDistrict','userPassword')->findOrFail($id);

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function edit($id)
    {
        $user = User::with('userDetails.userState','userDetails.userDistrict')->findOrFail($id);
        $banks = Bank::all();
        $states = State::all();
        $districts = District::all();
        return view('admin.users.edit', compact('user','banks','states','districts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int      $id
     *
     * @return void
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => ['required','string','max:255','regex:/(^[a-zA-Z\\s]*$)/u'],
            'email' => ['required','string','email','max:255'],
            'mob_no' =>['required','numeric'],
            'alternate_mob_no' => ['nullable','numeric'],
            'district_id' => 'required',
            'state_id' => 'required',
            'bank_id' => 'required',
            'account_no' => ['required','numeric'],
            'account_type' => 'required|string|max:255',
            'ifsc_code' => ['required','string','max:255','regex:/(^([A-Z|a-z]{4}[0][A-Z0-9a-z]{6}$))/u'],
            'branch' => 'required|string|max:255',
            'paytm_no' => 'max:255',
            'gpay_no' => 'max:255',
        ]);
        $user = User::findOrFail($id);
        $data = $request->all();
        if (!empty($data['password'])) {
            $password = $request->password;
            $userPassword = UserPassword::where('user_id', $id)->firstOrFail();
            $userPassword->update([
                'password' => $password
            ]);
            $data['password'] = bcrypt($request->password);
            $user->update([
                'name' => strtoupper($request->name),
                'user_name' => strtolower($request->user_name),
                'email' => strtolower($request->email),
                'password' => $data['password']
            ]);
        }
        else{
            $user->update([
                'name' => strtoupper($request->name),
                'user_name' => strtolower($request->user_name),
                'email' => strtolower($request->email),
        ]);
        }
        $userProfile = UserDetail::where('user_id',$id)->firstOrFail();
        $userProfile->update([
            'mob_no' => $request->mob_no,
            'alternate_mob_no' => $request->alternate_mob_no,
            'district_id' => strtoupper($request->district_id),
            'state_id' => strtoupper($request->state_id),
            'bank_id' => strtoupper($request->bank_id),
            'account_no' => $request->account_no,
            'account_type' => strtoupper($request->account_type),
            'ifsc_code' => strtoupper($request->ifsc_code),
            'branch' => strtoupper($request->branch),
            'paytm_no' => $request->paytm_no,
            'gpay_no' => $request->gpay_no,
        ]);
                
        return redirect('admin/users')->with('flash_message', 'User updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function destroy($id)
    {
        User::destroy($id);

        return redirect('admin/users')->with('flash_message', 'User deleted!');
    }

    public function viewSecurity()
    {
        return view('admin.users.changeAdminPass');
    }

    public function changeSecurity(Request $request)
    {
        $this->validate($request,[
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed'
        ]);
        $id = Auth::User()->id;
        $requestData = $request->all();
        $user = User::where('id',$id)->first();
        $oldPassword = $user->password;
        $currentPassword = $requestData['current_password'];
        if(Hash::check($currentPassword, $oldPassword))
        {
            $newPassword = Hash::make($requestData['password']);
            try
            {
                $user->update([
                    'password' => $newPassword
                ]);
                return redirect()->back()->with('flash_message','Password updated successfully');
            }
            catch (\Illuminate\Database\QueryException $e)
            {
                return redirect()->back()->withErrors($e->getMessage())->withInput();
            }
        }
        else
        {
            return redirect()->back()->withErrors('Current Password is Incorrect')->withInput();
        }

    }
}

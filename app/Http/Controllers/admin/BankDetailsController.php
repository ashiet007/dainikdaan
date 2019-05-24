<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\BankDetail;
use App\Bank;
use Illuminate\Http\Request;

class BankDetailsController extends Controller
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
            $bankdetails = BankDetail::select('bank_details.*')->with('users')
                                            ->join('users', 'users.id', '=', 'bank_details.user_id')
                                            ->where('users.name', 'LIKE', "%$keyword%")
                                            ->orWhere('users.username', 'LIKE', "%$keyword%")
                                            ->orWhere('bank_name', 'LIKE', "%$keyword%")
                                            ->orWhere('account_number', 'LIKE', "%$keyword%")
                                            ->orWhere('account_type', 'LIKE', "%$keyword%")
                                            ->orWhere('ifsc_code', 'LIKE', "%$keyword%")
                                            ->orWhere('branch', 'LIKE', "%$keyword%")
                                            ->orWhere('user_id', 'LIKE', "%$keyword%")
                                            ->paginate($perPage);
        } else {
            $bankdetails = BankDetail::with('users')->paginate($perPage);
        }

        return view('admin.bank-details.index', compact('bankdetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.bank-details.create');
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
        
        BankDetail::create($requestData);

        return redirect('admin/bank-details')->with('flash_message', 'BankDetail added!');
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
        $bankdetail = BankDetail::with('users')->findOrFail($id);

        return view('admin.bank-details.show', compact('bankdetail'));
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
        $banks = Bank::pluck('name','name')->toArray();
        $bankdetail = BankDetail::findOrFail($id);

        return view('admin.bank-details.edit', compact('bankdetail','banks'));
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
        $this->validate($request, [
            'bank_name' => 'required'
        ]);
        $requestData = $request->all();
        
        $bankdetail = BankDetail::findOrFail($id);
        $bankdetail->update($requestData);

        return redirect('admin/bank-details')->with('flash_message', 'BankDetail updated!');
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
        BankDetail::destroy($id);

        return redirect('admin/bank-details')->with('flash_message', 'BankDetail deleted!');
    }
}

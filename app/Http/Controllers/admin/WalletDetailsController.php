<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\WalletDetail;
use Illuminate\Http\Request;

class WalletDetailsController extends Controller
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
            $walletdetails = WalletDetail::select('wallet_details.*')->with('users')
                                            ->join('users', 'users.id', '=', 'wallet_details.user_id')
                                            ->where('users.name', 'LIKE', "%$keyword%")
                                            ->orWhere('users.username', 'LIKE', "%$keyword%")
                                            ->orWhere('paytm_number', 'LIKE', "%$keyword%")
                                            ->orWhere('gpay_number', 'LIKE', "%$keyword%")
                                            ->orWhere('bitcoin_address', 'LIKE', "%$keyword%")
                                            ->orWhere('user_id', 'LIKE', "%$keyword%")
                                            ->paginate($perPage);
        } else {
            $walletdetails = WalletDetail::with('users')->paginate($perPage);
        }

        return view('admin.wallet-details.index', compact('walletdetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.wallet-details.create');
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
        
        WalletDetail::create($requestData);

        return redirect('admin/wallet-details')->with('flash_message', 'WalletDetail added!');
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
        $walletdetail = WalletDetail::with('users')->findOrFail($id);

        return view('admin.wallet-details.show', compact('walletdetail'));
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
        $walletdetail = WalletDetail::findOrFail($id);

        return view('admin.wallet-details.edit', compact('walletdetail'));
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
        
        $walletdetail = WalletDetail::findOrFail($id);
        $walletdetail->update($requestData);

        return redirect('admin/wallet-details')->with('flash_message', 'WalletDetail updated!');
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
        WalletDetail::destroy($id);

        return redirect('admin/wallet-details')->with('flash_message', 'WalletDetail deleted!');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\AmountChart;
use Illuminate\Http\Request;

class AmountChartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $amountcharts = AmountChart::where('provide_amount', 'LIKE', "%$keyword%")
                ->orWhere('receive_amount', 'LIKE', "%$keyword%")
                ->orWhere('frequency', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $amountcharts = AmountChart::paginate($perPage);
        }

        return view('admin.amount-charts.index', compact('amountcharts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.amount-charts.create');
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
        
        AmountChart::create($requestData);

        return redirect('admin/amount-charts')->with('flash_message', 'AmountChart added!');
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
        $amountchart = AmountChart::findOrFail($id);

        return view('admin.amount-charts.show', compact('amountchart'));
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
        $amountchart = AmountChart::findOrFail($id);

        return view('admin.amount-charts.edit', compact('amountchart'));
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
        
        $amountchart = AmountChart::findOrFail($id);
        $amountchart->update($requestData);

        return redirect('admin/amount-charts')->with('flash_message', 'AmountChart updated!');
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
        AmountChart::destroy($id);

        return redirect('admin/amount-charts')->with('flash_message', 'AmountChart deleted!');
    }
}

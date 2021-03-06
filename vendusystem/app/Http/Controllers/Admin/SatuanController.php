<?php

namespace App\Http\Controllers\Admin;

use App\Pemilik;
use App\Satuan;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Section;
use App\User;
use Illuminate\Http\Request;
use Session;
use DB;
use Auth;
use File;

class SatuanController extends Controller
{
    private $perpage;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->perpage = 25;
        $this->middleware('admin');
    }

    /**
     * Show the form for view a list of satuan.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $satuans = new Satuan();
        $no = (($request->page - 1) * $this->perpage) + 1;
        $no = ($no < 1) ? 1 : $no;
        if($request->search)
            $satuans = $satuans->where('nama', 'LIKE', '%'.$request->search."%");

        $satuans = $satuans->orderBy('nama', "ASC");

        $satuans = $satuans->paginate($this->perpage);
        $appends = $request->except("page");
        return view('admin.page.satuan.index', compact('satuans', 'appends', 'no'));
    }

    /**
     * Show the form for creating a new satuan.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.page.satuan.create');
    }

    /**
     * Store the specified satuan in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|max:50'
        ]);

        $request["toko"] = null;

        $requestData = $request->all();

        $information = Satuan::create($requestData);

        return redirect('admin/satuan');
    }

    /**
     * Show the form for editing the specified satuan.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $information = Satuan::findOrFail($id);

        return view('admin.page.satuan.edit', compact("information"));
    }

    /**
     * Update the specified satuan in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|max:50'
        ]);

        $request["toko"] = null;

        $information = Satuan::findOrFail($id);

        $requestData = $request->all();

        $information->update($requestData);

        return redirect('admin/satuan');
    }

    /**
     * Retrieve destroy with id to delete the specified satuan.
     *
     * @param  int  $id
     *
     * @return int status
     */
    public function destroy($id)
    {
        $information = Satuan::destroy($id);

        if($information) {
            $data['message'] = "Berhasil di hapus!";
            $data['status'] = 200;
            $data['data'] = null;
        }else{
            $data['message'] = "Gagal di hapus!";
            $data['status'] = 404;
            $data['data'] = null;
        }


        return response()->json($data, $data["status"]);
    }


}

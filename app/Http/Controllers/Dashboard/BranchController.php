<?php

namespace App\Http\Controllers\Dashboard;

use Alert;
use App\DataTables\BranchDataTable;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
    public function index(BranchDataTable $mallDatatables)
    {
        return $mallDatatables->render('dashboard.datatable', [
            'title' => trans('site.branches'),
            'model' => 'branches',
            'count' => $mallDatatables->count(),
        ]);
    }//end of index

    public function create()
    {
        return view('dashboard.branches.create');
    }//end of create

    public function store(Request $request)
    {

//        $request->validate([
//            'name' => 'required|string',
//            'email' => 'required|string',
//            'bank_name' => 'required|string',
//            'type' => 'required|numeric',
//            'country' => 'required|string',
//            'city' => 'required|string',
//            'description' => 'require|string',
//
//        ]);
//        DB::beginTransaction();
//        try {
        $request_data = $request->all();
        $request_data['user_id'] = Auth::id();
        $mall = Branch::create($request_data);

        if ($request->hasFile('number_image')) {
            $thumbnail = $request->file('number_image');
            $destinationPath = 'uploads/branches/';
            $filename = time().'.'.$thumbnail->getClientOriginalExtension();
            //Image::make($thumbnail)->resize(100, 100)->save(public_path('/uploads/' . $filename));
            $thumbnail->move($destinationPath, $filename);
            $mall->number_image = $filename;
            $mall->save();
        }
        if ($request->hasFile('commerical_image')) {
            $thumbnail = $request->file('commerical_image');
            $destinationPath = 'uploads/branches/';
            $filename = time().'.'.$thumbnail->getClientOriginalExtension();
            //Image::make($thumbnail)->resize(100, 100)->save(public_path('/uploads/' . $filename));
            $thumbnail->move($destinationPath, $filename);
            $mall->commerical_image = $filename;
            $mall->save();
        }
        if ($request->hasFile('hoppy_image')) {
            $thumbnail = $request->file('hoppy_image');
            $destinationPath = 'uploads/branches/';
            $filename = time().'.'.$thumbnail->getClientOriginalExtension();
            //Image::make($thumbnail)->resize(100, 100)->save(public_path('/uploads/' . $filename));
            $thumbnail->move($destinationPath, $filename);
            $mall->hoppy_image = $filename;
            $mall->save();
        }
        if ($request->hasFile('tax_image')) {
            $thumbnail = $request->file('tax_image');
            $destinationPath = 'uploads/branches/';
            $filename = time().'.'.$thumbnail->getClientOriginalExtension();
            //Image::make($thumbnail)->resize(100, 100)->save(public_path('/uploads/' . $filename));
            $thumbnail->move($destinationPath, $filename);
            $mall->tax_image = $filename;
            $mall->save();
        }
        if ($request->hasFile('linces_image')) {
            $thumbnail = $request->file('linces_image');
            $destinationPath = 'uploads/branches/';
            $filename = time().'.'.$thumbnail->getClientOriginalExtension();
            //Image::make($thumbnail)->resize(100, 100)->save(public_path('/uploads/' . $filename));
            $thumbnail->move($destinationPath, $filename);
            $mall->linces_image = $filename;
            $mall->save();
        }
        if ($request->hasFile('work_image')) {
            $thumbnail = $request->file('work_image');
            $destinationPath = 'uploads/branches/';
            $filename = time().'.'.$thumbnail->getClientOriginalExtension();
            //Image::make($thumbnail)->resize(100, 100)->save(public_path('/uploads/' . $filename));
            $thumbnail->move($destinationPath, $filename);
            $mall->work_image = $filename;
            $mall->save();
        }
        if ($request->hasFile('row_image')) {
            $thumbnail = $request->file('row_image');
            $destinationPath = 'uploads/branches/';
            $filename = time().'.'.$thumbnail->getClientOriginalExtension();
            //Image::make($thumbnail)->resize(100, 100)->save(public_path('/uploads/' . $filename));
            $thumbnail->move($destinationPath, $filename);
            $mall->row_image = $filename;
            $mall->save();
        }
        if ($request->hasFile('iban_image')) {
            $thumbnail = $request->file('iban_image');
            $destinationPath = 'uploads/branches/';
            $filename = time().'.'.$thumbnail->getClientOriginalExtension();
            //Image::make($thumbnail)->resize(100, 100)->save(public_path('/uploads/' . $filename));
            $thumbnail->move($destinationPath, $filename);
            $mall->iban_image = $filename;
            $mall->save();
        }
        if ($mall) {
            Alert::success('Success', __('site.added_successfully'));

            return redirect()->route('dashboard.branches.index');
        }
    }//end of store

    public function edit($id)
    {
        $branch = Branch::find($id);

        return view('dashboard.branches.edit', compact('branch'));
    }//end of edit

    //
    public function show($id)
    {
        $branch = Branch::find($id);

        return view('dashboard.branches.show', compact('branch'));
    }//end of edit

    public function update(Request $request, $id)
    {
//        return $request;
//        $request->validate([
//            'name' => 'required|string',
//            'email' => 'required|string',
//            'bank_name' => 'required|string',
//            'type' => 'required|numeric',
//            'country' => 'required|string',
//            'city' => 'required|string',
//            'description' => 'require|string',
//        ]);
        $branch = Branch::find($id);
//        $request_data = $request->except('iban_image', 'row_image', 'work_image', 'number_image', 'commerical_image', 'hoppy_image', 'tax_image', 'linces_image');
        ////        DB::beginTransaction();
        ////        try {
        $branch->update([
            'type' => $request->type ?? '',
            'parent_id' => $request->parent_id ?? '',
            'name' => $request->name ?? '',
            'activity' => $request->activity ?? '',
            'country' => $request->country ?? '',

            'currency_id' => $request->currency_id ?? '',
            'city' => $request->city ?? '',
            'email' => $request->email ?? '',
            'manger_name' => $request->manger_name ?? '',
            'bank_name' => $request->bank_name ?? '',
            'number' => $request->number ?? '',
            'commerical_number' => $request->commerical_number ?? '',
            'number_hoppy' => $request->number_hoppy ?? '',
            'tax' => $request->tax ?? '',
            'linces' => $request->linces ?? '',
            'work_number' => $request->work_number ?? '',
            'row_number' => $request->row_number ?? '',
            'iban' => $request->iban ?? '',
            'description' => $request->description ?? '',

        ]);
        $branch->save();

//        return $branch;

        if ($request->hasFile('number_image')) {
            $thumbnail = $request->file('number_image');
            $destinationPath = 'uploads/branches/';
            $filename = time().'.'.$thumbnail->getClientOriginalExtension();
            //Image::make($thumbnail)->resize(100, 100)->save(public_path('/uploads/' . $filename));
            $thumbnail->move($destinationPath, $filename);
            $branch->number_image = $filename;
            $branch->save();
        }
        if ($request->hasFile('commerical_image')) {
            $thumbnail = $request->file('commerical_image');
            $destinationPath = 'uploads/branches/';
            $filename = time().'.'.$thumbnail->getClientOriginalExtension();
            //Image::make($thumbnail)->resize(100, 100)->save(public_path('/uploads/' . $filename));
            $thumbnail->move($destinationPath, $filename);
            $branch->commerical_image = $filename;
            $branch->save();
        }
        if ($request->hasFile('hoppy_image')) {
            $thumbnail = $request->file('hoppy_image');
            $destinationPath = 'uploads/branches/';
            $filename = time().'.'.$thumbnail->getClientOriginalExtension();
            //Image::make($thumbnail)->resize(100, 100)->save(public_path('/uploads/' . $filename));
            $thumbnail->move($destinationPath, $filename);
            $branch->hoppy_image = $filename;
            $branch->save();
        }
        if ($request->hasFile('tax_image')) {
            $thumbnail = $request->file('tax_image');
            $destinationPath = 'uploads/branches/';
            $filename = time().'.'.$thumbnail->getClientOriginalExtension();
            //Image::make($thumbnail)->resize(100, 100)->save(public_path('/uploads/' . $filename));
            $thumbnail->move($destinationPath, $filename);
            $branch->tax_image = $filename;
            $branch->save();
        }
        if ($request->hasFile('linces_image')) {
            $thumbnail = $request->file('linces_image');
            $destinationPath = 'uploads/branches/';
            $filename = time().'.'.$thumbnail->getClientOriginalExtension();
            //Image::make($thumbnail)->resize(100, 100)->save(public_path('/uploads/' . $filename));
            $thumbnail->move($destinationPath, $filename);
            $branch->linces_image = $filename;
            $branch->save();
        }
        if ($request->hasFile('work_image')) {
            $thumbnail = $request->file('work_image');
            $destinationPath = 'uploads/branches/';
            $filename = time().'.'.$thumbnail->getClientOriginalExtension();
            //Image::make($thumbnail)->resize(100, 100)->save(public_path('/uploads/' . $filename));
            $thumbnail->move($destinationPath, $filename);
            $branch->work_image = $filename;
            $branch->save();
        }
        if ($request->hasFile('row_image')) {
            $thumbnail = $request->file('row_image');
            $destinationPath = 'uploads/branches/';
            $filename = time().'.'.$thumbnail->getClientOriginalExtension();
            //Image::make($thumbnail)->resize(100, 100)->save(public_path('/uploads/' . $filename));
            $thumbnail->move($destinationPath, $filename);
            $branch->row_image = $filename;
            $branch->save();
        }
        if ($request->hasFile('iban_image')) {
            $thumbnail = $request->file('iban_image');
            $destinationPath = 'uploads/branches/';
            $filename = time().'.'.$thumbnail->getClientOriginalExtension();
            //Image::make($thumbnail)->resize(100, 100)->save(public_path('/uploads/' . $filename));
            $thumbnail->move($destinationPath, $filename);
            $branch->iban_image = $filename;
            $branch->save();
        }

        if ($branch) {
            Alert::success('Success', __('site.updated_successfully'));

            return redirect()->route('dashboard.branches.index');
        } else {
            flash(__('site.update_faild'))->success();
        }

        return redirect()->route('dashboard.branches.index');
    }

    public function destroy($id)
    {
        $mall = Branch::find($id);
        if (! $mall) {
            Alert::toast('Deleted', __('site.delete_faild'));

            return back();
        }
        $result = $mall->delete();
        if ($mall) {
            Alert::toast('Deleted', __('site.deleted_successfully'));
        } else {
            Alert::error('Error', __('site.delete_faild'));
        }

        return back();
    }
}//end of controller

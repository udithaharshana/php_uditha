<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\Saller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Exception;
use Yajra\Datatables\Datatables;

class SallerController extends Controller
{

    /* Saller Home Page */
    public function HomePage()
    {
        return view('pages/saller_home');
    }

    /* Saller New Page */
    public function New()
    {
        $data['routes'] = Route::Where('status', '1')->get();

        return view('pages/saller_edit')->with($data);
    }

    /* Saller Edit Page */
    public function Edit(Request $request)
    {
        try {
            $data['saller'] = Saller::find($request->sid);
            $data['routes'] = Route::Where('status', '1')->get();

            return view('pages/saller_edit')->with($data);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    /* Validation funtion */
    //saleer name validation
    public function name_validate(Request $request)
    {
        $data = Saller::where('name', $request->name)->where('sid', '!=', $request->sid)->exists();
        return response()->json($data);
    }

    /*  Saller save funtion
        using both new/edit pages
    */
    public function save(Request $request)
    {
        try {
            /* backend validation */
            $rules = [
                'name' => ['required', Rule::unique('saller', 'name')->ignore($request->sid, 'sid')],
                'telephone' => 'required',
                'join_date' => 'required',
                'rid' => 'required',
                'email' => ['nullable', 'email', Rule::unique('saller', 'email')->ignore($request->sid, 'sid')]
            ];
            $customMessages = [
                'name.required' => 'Saller Name is required',
                'name.unique'=> 'Already Existing Saller Name',
                'telephone.required' => 'Saller telephone is required',
                'join_date.required' => 'Join Date is required',
                'email.email' => 'Invalid email address',
                'email.unique' => 'Already Existing Saller email address',
            ];

            /* if validation fails redirect back with errors */
            $validatedData = Validator::make($request->all(), $rules, $customMessages);
            if ($validatedData->fails()) {
                return redirect()->back()->withErrors($validatedData)->withInput();
            } else {

                /* create or update saller */
                $saller = $request->sid ? Saller::find($request->sid) : new Saller();
                $saller->name = $request->name;
                $saller->email = $request->email;
                $saller->telephone = $request->telephone;
                $saller->route_id = $request->rid;
                $saller->join_date = date('Y-m-d', strtotime(str_replace('/', '-', $request->join_date)));
                $saller->comment = $request->remark;
                $saller->save();

                return redirect('/sales_team');
            }
        } catch (Exception $e) {

            return  App::environment('local') ? dd($e->getMessage(), $e->getLine()) : '';
        }
    }

    /* get datatable's data in sales Team page */
    public function HomeData(Request $request)
    {
        try {
            $data = Saller::with(['route'])->get();
            return Datatables::of($data)->toJson();

        } catch (Exception $e) {
            return response('');
        }
    }

    /* view
        seller details to modal box
    */
    public function Preview(Request $request)
    {
        try {
            $saller = Saller::with(['route'])->find($request->sid);
            return response()->json($saller);

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }


}

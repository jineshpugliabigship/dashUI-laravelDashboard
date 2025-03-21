<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUser;

use App\Imports\MasterCourierRatesImport;
use App\Models\Mastercourierrates;
use App\Models\User;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;



class MasterCourierRatesController extends Controller
{
    use HasRoles;

    function __construct()
    {
        $this->middleware('role_or_permission:SuperAdmin|User access|User create|User edit|User delete', ['only' => ['index', 'show']]);
        $this->middleware('role_or_permission:SuperAdmin|User create', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:SuperAdmin|User edit', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:SuperAdmin|User delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch all master courier rates
        $masterCourierRates = MasterCourierRates::all();

        // Fetch users excluding SuperAdmin

        return view('admin.mastercourierrates.index', compact('masterCourierRates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::whereNotIn('name', ['SuperAdmin'])->get();
        return view('admin.mastercourierrates.create', compact('roles'));
    }

    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file_upload' => 'required|mimes:csv,xlsx|max:2048'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {

            Excel::import(new MasterCourierRatesImport, $request->file('file_upload'));
            DB::commit();
            return back()->with('success', 'Rates imported successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Import Error: ' . $e->getMessage());
            return back()->with('error', 'Error importing file. Please check the file format or content.');
        }
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUser $request, FlasherInterface $flasher)
    {
        $inputs = $request->all();
        $user = MasterCourierRates::create($inputs);

        if ($inputs['role'] != 0) {
            $user->syncRoles($request->role);
        } else {
            $user->assignRole('User');
        }

        $flasher->addSuccess('User Created', 'Dash UI');
        return redirect(route('admin.mastercourierrates.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect(route('admin.mastercourierrates.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, FlasherInterface $flasher)
    {
        $user = MasterCourierRates::findOrFail($id);

        // If User Role is SuperAdmin it will be Redirected;
        foreach ($user->roles as $role) {
            if ($role->name == 'SuperAdmin' || auth()->user()->hasRole($role->name)) {
                $flasher->addError('Not Allowed', 'Dash UI');
                return redirect(route('admin.mastercourierrates.index'));
            }
        }

        $roles = Role::whereNotIn('name', ['SuperAdmin'])->get();
        return view('admin.mastercourierrates.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, FlasherInterface $flasher)
    {
        $user = MasterCourierRates::findOrFail($id);
        $user->username = $request->usermname;
        $userRole = $request->role;
        $inputs = $request->all();

        if ($user->isDirty('username')) {
            $user->update([
                'username' => $request->username
            ]);
        }

        $user->syncRoles($userRole);

        $user->update($inputs);
        $flasher->addSuccess('User "' . $user->name . '" updated.', 'Dash UI');
        return redirect(route('admin.mastercourierrates.index'));
    }

    public function passUpdate(Request $request, $id, FlasherInterface $flasher)
    {
        $user = MasterCourierRates::findOrFail($id);

        $request->validate([
            'password' => 'required|confirmed|min:5'
        ]);
        $user->password = $request->password;

        if ($user->isDirty('password')) {
            $hashPass = bcrypt($request->password);
            $user->update([
                'password' => $hashPass
            ]);
            $flasher->addSuccess('Password Updated');
        }

        return redirect(route('admin.mastercourierrates.index'));
    }

    public function othersUpdate(Request $request, $id, FlasherInterface $flasher)
    {
        $user = MasterCourierRates::findOrFail($id);

        $request->validate([
            'phone'      => 'required|numeric|min:11',
        ]);

        $inputs = $request->all();
        $user->phone = $inputs['phone'];

        if ($user->isDirty('phone')) {
            $user->update($inputs);
        } else {
            $user->update([
                'location'  =>  $inputs['location'],
                'about'     =>  $inputs['about']
            ]);
        }

        $flasher->addSuccess('Profile Updated', 'Dash UI');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FlasherInterface $flasher, User $user)
    {
        // If User Role is SuperAdmin it will be Redirected;
        foreach ($user->roles as $role) {
            if ($role->name == 'SuperAdmin' || auth()->user()->hasRole($role->name)) {
                $flasher->addError('Not Allowed', 'Dash UI');
                return redirect(route('admin.mastercourierrates.index'));
            }
        }

        $user->delete();
        $flasher->addInfo('User Deleted Successfully', 'Dash UI');
        return redirect()->back();
    }
}

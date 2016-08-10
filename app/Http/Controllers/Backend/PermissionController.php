<?php

namespace Eybos\Http\Controllers\Backend;

use Eybos\Http\Requests;

use Eybos\Permission;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class PermissionController extends Controller
{
    /**
     * @author Pranab Kalita <pranab.k@cisinlabs.com>
     * Permission attribute to hold the permission model for the controller
     */
    protected $permission;

    /**
     * @author Pranab Kalita <pranab.k@cisinlabs.com>
     * Contrustor to instantiate the Permission model for the controller
     * @param Permission $permission Permission model injected in the constructor
     */
    public function __construct(Permission $permission)
    {
        $this->permission = $permission;

        parent::__construct();
    }

    /**
     * @author Pranab Kalita <pranab.k@cisinlabs.com>
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $permissions = $this->permission->orderBy('id', 'desc')->paginate(15);

        return view('backend.permissions.index', compact('permissions'));
    }

    /**
     * @author Pranab Kalita <pranab.k@cisinlabs.com>
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create(Permission $permission)
    {
        return view('backend.permissions.form', compact('permission'));
    }

    /**
     * @author Pranab Kalita <pranab.k@cisinlabs.com>
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        
        Permission::create($request->all());

        Session::flash('flash_message', 'Permission added!');

        return redirect('backend/permissions');
    }

    /**
     * @author Pranab Kalita <pranab.k@cisinlabs.com>
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function show($id)
    {
        $permission = $this->permission->findOrFail($id);

        return view('backend.permissions.show', compact('permission'));
    }

    /**
     * @author Pranab Kalita <pranab.k@cisinlabs.com>
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function edit($id)
    {
        $permission = $this->permission->findOrFail($id);

        return view('backend.permissions.form', compact('permission'));
    }

    /**
     * @author Pranab Kalita <pranab.k@cisinlabs.com>
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function update($id, Request $request)
    {
        $permission = $this->permission->findOrFail($id);
        $permission->update($request->all());

        return redirect()->route('backend.permissions.index')->with('success', 'Permission updated successfully!!!');
    }

    /**
     * @author Pranab Kalita <pranab.k@cisinlabs.com>
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function destroy($id)
    {
        $this->permission->destroy($id);

        return redirect()->route('backend.permissions.index')->with('success', 'Permission deleted successfully!!!');
    }
}

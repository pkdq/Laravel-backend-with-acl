<?php

namespace Eybos\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Eybos\Role;
use Eybos\Permission;
use DB;

use Eybos\Http\Requests;

class RoleController extends Controller
{
    /**
     * @author Pranab Kalita <pranab.k@cisinlabs.com>
     * Role attribute to hold the role model for the controller
     */
    protected $role;

     /**
     * @author Pranab Kalita <pranab.k@cisinlabs.com>
     * Role to instantiate the Role model for the controller
     * @param Role $role Role model injected in the constructor
     */
    public function __construct(Role $role)
    {
        $this->role = $role;

        parent::__construct();
    }

    /**
     * @author Pranab Kalita <pranab.k@cisinlabs.com>
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = $this->role->orderBy( 'id', 'desc' )->paginate();
        return view( 'backend.roles.index', compact('roles') )->with( 'i', ( $request->input( 'page', 1 ) -1 ) * 5 );
    }

    /**
     * @author Pranab Kalita <pranab.k@cisinlabs.com>
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Role $role)
    {
        $permissions = Permission::get();
        $rolePermissions = [];
        return view( 'backend.roles.form', compact( 'role', 'permissions', 'rolePermissions' ) );
    }

    /**
     * @author Pranab Kalita <pranab.k@cisinlabs.com>
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate( $request, [
        //     'name' => 'required|unique:roles,name',
        //     'display_name' => 'required',
        //     'description' => 'required',
        //     'permission' => 'required'
        // ] );

        $role = Role::create( $request->all() );

        foreach ($request->input('permissions') as $permission) {
            $role->attachPermission( $permission );
        }

        return redirect()->route( 'backend.roles.index' )->with( 'success', 'Role Cerated Successfully.' );
    }

    /**
     * @author Pranab Kalita <pranab.k@cisinlabs.com>
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = $this->role->findOrFail( $id );
        $rolePermissions = Permission::join( 'permission_role', 'permission_role.permission_id', '=', 'permissions.id' )->where('permission_role.role_id', $id)->get();

        return view( 'backend.roles.show', compact('role', 'rolePermissions') );
    }

    /**
     * @author Pranab Kalita <pranab.k@cisinlabs.com>
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = $this->role->findOrFail( $id );
        $permissions = Permission::get();
        $rolePermissions = DB::table( 'permission_role' )->where( 'permission_role.role_id', $id )->lists( 'permission_role.permission_id', 'permission_role.permission_id' );

        return view( 'backend.roles.form', compact('role', 'permissions', 'rolePermissions') );
    }

    /**
     * @author Pranab Kalita <pranab.k@cisinlabs.com>
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $this->validate( $request, [
        //     'display_name' => 'required',
        //     'description' => 'required',
        //     'permission' => 'required'
        // ] );

        $role = $this->role->findOrFail( $id );

        $role->update( $request->all() );

        DB::table( 'permission_role' )->where( 'permission_role.role_id', $id )->delete();

        if( !empty( $request->input( 'permissions' ) ) ) {
            foreach ($request->input( 'permissions' ) as $permisison) {
                $role->attachPermission( $permisison );
            }    
        }

        return redirect()->route( 'backend.roles.index' )->with( 'success', 'Role updates successfully.' );
    }

    /**
     * @author Pranab Kalita <pranab.k@cisinlabs.com>
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = $this->role->findOrFail( $id );
        
        $role->users()->sync([]); 
        $role->perms()->sync([]); 

        $role->forceDelete(); 
        
        return redirect()->route( 'backend.roles.index' )->with( 'success', 'Role deleted successfully.' );
    }
}

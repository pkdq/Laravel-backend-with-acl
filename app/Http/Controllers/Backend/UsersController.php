<?php

namespace Eybos\Http\Controllers\Backend;

use Illuminate\Http\Request;

use Eybos\User;
use Eybos\Role;
use DB;
use Hash;
use Eybos\Http\Requests;
use Eybos\Http\Controllers\Backend;

class UsersController extends Controller
{
    /**
     * @author Pranab Kalita <pranab.k@cisinlabs.com>
     * Role attribute to hold the role model for the controller
     */
    protected $users;

    /**
     * @author Pranab Kalita <pranab.k@cisinlabs.com>
     * Contrustor to instantiate the Role model for the controller
     * @param User $user User model injected in constructor
     */
    public function __construct(User $user)
    {
        $this->users = $user;

        parent::__construct();
    }

    /**
     * @author Pranab Kalita <pranab.k@cisinlabs.com>
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->users->orderBy('id', 'desc')->paginate(10);

        return view('backend.users.index', compact('users'));
    }

    /**
     * @author Pranab Kalita <pranab.k@cisinlabs.com>
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        $roles = Role::lists( 'display_name', 'id' );
        return view('backend.users.form', compact('user', 'roles'));
    }

    /**
     * @author Pranab Kalita <pranab.k@cisinlabs.com>
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StoreUserRequest $request)
    {
        $input = $request->all();
        if( !empty($input['password']) )
            $input['password'] = bcrypt( $input['password'] );
        
        $user = User::create( $input );
        foreach ($request->input('roles') as $role)
        {
            $user->attachRole( $role );
        }

        return redirect( route('backend.users.index') )->with('success', 'User has been created.');
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
        $user = $this->users->findOrFail( $id );
        $roles = Role::lists( 'display_name', 'id' );
        $userRoles = $user->roles->lists( 'id', 'id' )->toArray();

        return view('backend.users.form', compact('user', 'roles', 'userRoles'));
    }

    /**
     * @author Pranab Kalita <pranab.k@cisinlabs.com>
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdateUserRequest $request, $id)
    {
        $input = $request->all();

        if ( !empty($input['password']) ) {
            $input['password'] = Hash::make( $input['password'] );
        } else {
            unset( $input[ 'password' ] );
        }

        $user = User::find( $id );
        $user->update( $input );
        DB::table( 'role_user' )->where( 'user_id', $id )->delete();

        foreach ($request->input('roles') as $role) {
            $user->attachRole( $role );
        }

        return redirect(route('backend.users.edit', $user->id))->with('success', 'User has been updated');
    }

    public function confirm( Requests\DeleteUserRequest $request, $id )
    {
        $user  = $this->users->findOrFail($id);

        return view( 'backend.users.confirm', compact('user') );
    }

    /**
     * @author Pranab Kalita <pranab.k@cisinlabs.com>
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Requests\DeleteUserRequest $request, $id )
    {
        $user = $this->users->findOrFail( $id );

        $user->delete();

        return redirect( route( 'backend.users.index' ) )->with( 'status', 'User has been deleted!!' );
    }
}

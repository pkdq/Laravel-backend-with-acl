<?php

namespace Eybos\Http\Controllers\Backend;

use Eybos\Post;
use Eybos\User;

class DashboardController extends Controller
{
	/**
	 * @author Pranab Kalita <pranab.k@cisinlabs.com>
	 * Display the dashboard of the logged in user
	 * @param  Post   $posts [description]
	 * @param  User   $users [description]
	 * @return [type]        [description]
	 */
    public function index(Post $posts, User $users)
    {
        
        return view( 'backend.dashboard' );
    }
}
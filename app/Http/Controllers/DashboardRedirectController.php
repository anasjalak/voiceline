<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\App;
 
use App\Models\User;
use Illuminate\Http\RedirectResponse;
//use PhpParser\Node\Stmt\Return_;

class DashboardRedirectController extends Controller
{
    public function __invoke(): RedirectResponse
    {
        //dd(auth()->id(), auth()->user());
    //    return match (auth()->user()->role) {
            Return match(auth()->user()->role){
        User::ROLE_ADMIN      => redirect()->route('admin.dashboard'),
    User::ROLE_SUPERVISOR => redirect()->route('supervisor.dashboard'),
    User::ROLE_USER       => redirect()->route('user.dashboard'),
    default               => abort(403, 'Unauthorized role'),

        };

       

    }
}

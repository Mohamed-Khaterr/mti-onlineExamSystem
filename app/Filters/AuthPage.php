<?php 

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthPage implements FilterInterface
{
    public function before(RequestInterface $request,$arguments = null)
    {	
	/*
        // Do something here
        if(session()->get('isLoggedIn')){
			if(session()->get('isDoctor')){
				return redirect()->to('Doctor');
				
			}elseif(session()->get('isAdmin')){
				return redirect()->to('Admin');
				
			}elseif(session()->get('isStudent')){
				return redirect()->to('student');
			}
		}
*/
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response,$arguments = null)
    {
        // Do something here
    }
}
<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth  implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {	
		//if not login go to Login page
        if(!session()->get('isLoggedIn')){
			return redirect()->to('Login');
		}
		/*
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
	
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
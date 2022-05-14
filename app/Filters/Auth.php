<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth  implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {	
		$uri = service('uri');
		//if not login go to Login page
        if(!session()->get('isLoggedIn')){
			return redirect()->to('Login');
		}
		
		if(session()->get('isLoggedIn')){
			if(session()->get('isDoctor') && $uri->getSegmaent(1) != "Doctor"){
				return redirect()->to('Doctor');
				
			}elseif(session()->get('isAdmin') && $uri->getSegment(1) != "Admin"){
				return redirect()->to('Admin');
				
			}elseif(session()->get('isStudent') && $uri->getSegment(1) != "student"){
				return redirect()->to('student');
			}
		}
	}
	
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
		// Do something here
    }
}
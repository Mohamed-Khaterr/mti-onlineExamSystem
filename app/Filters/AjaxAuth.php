<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AjaxAuth  implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {	
		// if not login go to Login page
        if(!session()->get('isLoggedIn')){
			return redirect()->to('Login');
		}
	}
	
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
		// Do something here
    }
}
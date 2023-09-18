<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Noauth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->get('isLoggedIn')) {
            if (session()->get('DAStaff_username')) {
                return redirect()->to(base_url('admin'));
            } else if (session()->get('MSO_username')) {
                return redirect()->to(base_url('mso'));
            } else if (session()->get('Inspector_username')) {
                return redirect()->to(base_url('inspector'));
            } else if (session()->get('Treasurer_username')) {
                return redirect()->to(base_url('treasurer'));
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}

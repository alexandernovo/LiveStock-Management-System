<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class InspectorFilter implements FilterInterface
{

    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->has('Inspector_username')) {
            session()->setFlashdata('failed', 'Please Login first');
            return redirect()->to(base_url('login'));
        }
    }
    //--------------------------------------------------------------------
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}

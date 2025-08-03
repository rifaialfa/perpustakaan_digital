<?php namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel; 

class AuthFilter implements FilterInterface
{

    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        if (!$session->get('isLoggedIn')) {
            return redirect()->to(base_url('login'));
        }

        $userModel = new UserModel();
        $user = $userModel->find($session->get('id'));

        if ($user) {
            $session->set('role', $user->role); 
        } else {
        
            $session->destroy();
            return redirect()->to(base_url('login'));
        }
        
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // ...
    }
}

public function before(RequestInterface $request, $arguments = null)
{
    if (!session()->get('isLoggedIn')) {
        return redirect()->to('/login');
    }
    
    if ($arguments && !in_array(session()->get('role'), $arguments)) {
        return redirect()->to('/unauthorized');
    }
}
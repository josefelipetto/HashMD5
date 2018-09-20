<?php
/**
 * Created by PhpStorm.
 * User: josefelipetto
 * Date: 20/09/18
 * Time: 13:13
 */

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class LoginController
 * @package App\Controllers
 */
class LoginController extends Controller
{
    /**
     * @var static
     */
    protected $input;

    /**
     * @var mixed
     */
    protected $user;

    /**
     * @var mixed
     */
    protected $password;

    protected static $algorithm = 'md5';

    /**
     * LoginController constructor.
     */
    public function __construct()
    {

        $this->input = Request::createFromGlobals();

        $this->user = $this->input->get('user');

        $this->password = $this->input->get('password');

    }

    /**
     * Load the login view
     */
    public function index()
    {
        $this->view('login');
    }

    /**
     * Log into the system
     * @return bool
     */
    public function login()
    {
        $handle = fopen('src/resources/users','r');

        $matches = 0;

        if( ! $handle )
        {
            $this->view('login', [
                "errors" => [' Erro ao abrir arquivo. Verifique']
            ]);

            return false;
        }


        while( ! feof($handle) )
        {
            $buffer = fgets($handle);

            if( (strpos($buffer, $this->user) !== FALSE)
                ||  (strpos($buffer, hash(self::$algorithm, $this->password)) !== FALSE) )
            {
                $matches++;
            }
        }


        if($matches != 2)
        {
            $this->view('login', [
                "errors" => [' Usuário ou senha incorretos. Verifique']
            ]);
            return false;
        }

        $this->redirect('main');

        return true;
    }




}
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
 * Class UserController
 * @package App\Controllers
 */
class UserController extends Controller
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
     * UserController constructor.
     */
    public function __construct()
    {

        $this->input = Request::createFromGlobals();

        $this->user = $this->input->get('user');

        $this->password = $this->input->get('password');

        self::$algorithm = $this->input->get('algType');

    }

    /**
     * Load the new User view
     */
    public function index()
    {
        $this->view('newUser');
    }

    /**
     * Add a new user
     */
    public function newUser()
    {

        if( strlen($this->user) != 4 && strlen($this->password) != 4)
        {
            $this->view('newUser', [
                "errors" => [' Usuário e senha devem conter 4 caracteres cada. Verifique']
            ]);

            return false;
        }

        $usersFile =  'src/resources/users';

        file_put_contents($usersFile,[

            $this->user,
            PHP_EOL,
            hash(self::$algorithm, $this->password)

        ]);

        $this->view('login', [

            "success" => 'Novo usuário cadastrado com sucesso!'

        ]);

        return true;
    }


}
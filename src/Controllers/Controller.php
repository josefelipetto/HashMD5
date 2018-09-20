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
 * Class Controller
 * @package App\Controllers
 */
abstract class Controller
{

    /**
     * @param string $viewName
     */
    public function view(string $viewName, $dataAux = [])
    {

        // Passa dados para a view
        if ( count($dataAux) > 0 )
        {
            $data = $dataAux;
        }

        require_once $this->getView($viewName);
    }

    /**
     * @param string $viewName
     * @return bool|string
     */
    private function getView(string $viewName)
    {

        $pathView = 'src/public/html/' . $viewName . '.php';

        if( ! is_file($pathView))
        {
            throw new \BadMethodCallException('View não existente. Verifique');
        }

        return $pathView;

    }


    /**
     * @param string $redirectTo
     * @param string $message
     */
    public function redirect(string $redirectTo, $message = '')
    {

        if($message != '')
        {
            $this->alert($message);
        }

        header('Location: ' . $redirectTo);

        exit();

    }

    /**
     * @param $message
     */
    private function alert($message)
    {
        echo '<script type="application/javascript"> 
                    alert(' . $message . ');  
                  </script> ';
    }

}
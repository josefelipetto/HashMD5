<?php
/**
 * Created by PhpStorm.
 * User: josefelipetto
 * Date: 20/09/18
 * Time: 13:13
 */

namespace App\Controllers;

set_time_limit(0);

define('PASSWORD_LENGTH', 4);

/**
 * Class MainController
 * @package App\Controllers
 */
class MainController extends Controller
{
    /**
     * @var
     */
    protected $startTime;

    /**
     * @var
     */
    protected $endTime;

    /**
     * @var
     */
    protected $time;

    /**
     * @var
     */
    protected $hash;

    /**
     * @var
     */
    protected $charset;

    /**
     * @var
     */
    protected $str_length;


    /**
     *
     */
    public function index()
    {
        $this->view('main');
    }

    /**
     * Brute force on the hash
     */
    public function breakMD5()
    {

        $this->charset  = 'abcdefghijklmnopqrstuvwxyz';
        $this->charset .= '0123456789';
        $this->charset .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $this->charset .= '~`!@#$%^&*()-_\/\'";:,.+=<>? ';

        $this->str_length = strlen($this->charset);

        $this->startTime = $this->getMicroTime();

        $this->hash = $this->getSenha();

        $this->recurse(4,0,'');

        echo "Execução completada";

    }

    /**
     * @param $width
     * @param $position
     * @param $base_string
     */
    private function recurse($width, $position, $base_string)
    {
        for($i = 0; $i < $this->str_length; ++$i)
        {
            if($position < $width - 1)
            {
                $this->recurse(
                    $width,
                    $position + 1,
                    $base_string . $this->charset[$i]
                );
            }

            if( $this->check($base_string . $this->charset[$i]))
            {
                break;
            }
        }
    }

    /**
     * @return float
     */
    private function getMicroTime()
    {
        list($uSec, $sec) = explode(" ", microtime());
        return ((float)$uSec + (float)$sec);
    }

    /**
     * @param $password
     * @return bool
     */
    private function check($password)
    {

        if( $this->hash == md5($password))
        {

            echo '<br><br> Senha quebrada! Senha: ' . $password . "\n\n";

            $this->endTime = $this->getMicroTime();

            $this->time = $this->endTime - $this->startTime;

            echo 'Tempo gasto: ' . number_format($this->time,2,'.','') . " segundos <br>";

            return true;

        }

        return false;
    }

    /**
     * @return bool|string
     */
    private function getSenha()
    {

        $handle = fopen("src/resources/users",'r');
        $i = 0;
        while(($line = fgets($handle)) !== FALSE)
        {
            if($i == 1)
            {
                return $line;
            }
            $i++;
        }

        fclose($handle);
        return false;

    }
}
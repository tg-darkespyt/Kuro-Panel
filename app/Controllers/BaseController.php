<?php

namespace App\Controllers;

use App\Models\CodeModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */

class BaseController extends Controller
{
	/**
	 * Instance of the main Request object.
	 *
	 * @var IncomingRequest|CLIRequest
	 */
	protected $request;

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['nata', 'form', 'url', 'text', 'html', 'filesystem'];
  
	/**
	 * Constructor.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param LoggerInterface   $logger
	 */
	function getUserIP()
	{
        $clientIp  = @$_SERVER['HTTP_CLIENT_IP'];
        $forwardIp = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remoteIp  = $_SERVER['REMOTE_ADDR'];
        if(filter_var($clientIp, FILTER_VALIDATE_IP))
        {
            $ipaddress = $clientIp;
        }
        elseif(filter_var($forwardIp, FILTER_VALIDATE_IP))
        {
            $ipaddress = $forwardIp;
        }
        else
        {
            $ipaddress = $remoteIp;
        }
        return $ipaddress;
    }
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.: $this->session = \Config\Services::session();
	}
}

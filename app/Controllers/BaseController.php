<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\DAStaffModel;
use App\Models\QueryModel;
use App\Models\MSOModel;
use App\Models\TreasurerModel;
use App\Models\InspectorModel;
use App\Models\ScheduleModel;
use App\Models\InspectStatusModel;
use App\Models\PaymentStatusModel;
use Twilio\Rest\Client;


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
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];
    protected $session;
    protected $dastaffmodel;
    protected $querymodel;
    protected $msomodel;
    protected $treasurermodel;
    protected $inspectormodel;
    protected $schedulemodel;
    protected $twilio;
    protected $inspectstatusmodel;
    protected $paymentstatusmodel;

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);
        // Preload any models, libraries, etc, here.
        $this->session = \Config\Services::session();
        $this->dastaffmodel = new DAStaffModel();
        $this->querymodel = new QueryModel();
        $this->msomodel = new MSOModel();
        $this->treasurermodel = new TreasurerModel();
        $this->inspectormodel = new InspectorModel();
        $this->schedulemodel = new ScheduleModel();
        $sidbackup = "ACabc61b70c52cc8e9ef563624a75040d9";
        $tokenbackup = "5b8e502ffe8c26f29772b16935f3d3a9";
        $this->twilio = new Client($sidbackup, $tokenbackup);
        $this->inspectstatusmodel = new InspectStatusModel();
        $this->paymentstatusmodel = new PaymentStatusModel();
    }
}

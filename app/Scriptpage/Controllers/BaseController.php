<?php

namespace App\Scriptpage\Controllers;

use App\Http\Controllers\Controller;
use App\Scriptpage\Contracts\ICrud;
use Illuminate\Http\JsonResponse;
use App\Scriptpage\Contracts\IRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class BaseController extends Controller
{

    /**
     * template
     *
     * @var string
     */
    protected $template;



    /**
     * repository
     *
     * @var IRepository
     */
    protected IRepository $repository;



    /**
     * crud
     *
     * @var mixed
     */
    protected ICrud $crud;

    

    /**
     * repositoryClass
     *
     * @var String
     */
    protected $repositoryClass;



    /**
     * crudClass
     *
     * @var String
     */
    protected $crudClass;



    /**
     * __construct
     *
     * @param  Request $request
     * @return BaseController
     */
    public function __construct(Request $request)
    {
        if (!empty($this->repositoryClass)) {
            $this->repository = app($this->repositoryClass);
            $this->repository->requestData($request);
        }

        if (!empty($this->crudClass)) $this->crud = app($this->crudClass);

        // Custom init
        $this->bootstrap();

        return $this;
    }



    /**
     * Custom init
     *
     * @return void
     */
    protected function bootstrap()
    {
    }



    /**
     * render
     *
     * @param  mixed $component
     * @param  mixed $props
     * @return \Inertia\Response
     */
    final function render($component, $props = []): Response
    {
        return Inertia::render($component, $props);
    }



    /**
     * setBack
     *
     * @param  Request $request
     * @return void
     */
    public function setSessionUrl(Request $request)
    {
        session(['url' => $request->fullUrl()]);
    }



    /**
     * Get redirect url
     *
     * @param String $route
     * @param  mixed $id
     * @param  mixed $id2
     * @return String
     */
    // final function getUrl(string $route = 'index', $id = null, $id2 = null)
    final function getSessionUrl()
    {
        return session('url');
    }

}

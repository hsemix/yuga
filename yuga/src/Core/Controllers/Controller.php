<?php
namespace Yuga\Controllers;

use Yuga\Http\Request;
use Yuga\Shared\Controller as SharedController;

class Controller
{
    use SharedController;

    public function __construct()
    {
        $this->init();
    }

    protected function init()
    {
        /**
        *   Initialize all controller defaults
        */
        $this->getApp();
        $this->getHash();
        $this->getCookie();
        $this->getRequest();
        $this->getSession();
        $this->getResponse();
        $this->getValidator();
        $this->getLoggedInUserId();
    }

    public function validate(Request $request, $rules = [])
    {
        $fields = $request->getInput()->all();
        unset($fields['_token']);
        $validation = $this->validate->check($request->getInput()->all(), $rules);
        if ($validation->failed()) {
            if ($request->isAjax()) {
                return $validation->errors();
            } else {
                $this->session->put('errors', $validation->errors());
                $this->request->addOld();
                return $this->response->redirect->back();
            } 
        }
        $this->session->delete('old-data');
        return $validation->getValidated();
    }
}
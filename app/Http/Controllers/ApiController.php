<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    /**
     * describes the response status code
     * @var integer
     */
    protected $statusCode = 200;
    /**
     * array containing all the validation rules
     * @var array
     */
    protected $validation_errors = [];

    protected $request;

    /**
     * [responseNotFound description]
     * @param  string $message [description]
     * @return [type]          [description]
     */
    public function responseNotFound($message="Could not locate the specified resource")
    {
        return $this->setStatusCode(404)->respondWithError($message);
    }

    /**
     * [responseInternalError description]
     * @param  string $message [description]
     * @return [type]          [description]
     */
    public function responseInternalError($message="Internal Error !")
    {
        return $this->setStatusCode(500)->respondWithError($message);
    }
    /**
     * [respond description]
     * @param  [type] $data    [description]
     * @param  array  $headers [description]
     * @return [type]          [description]
     */
    public function respond($data, $headers= [])
    {
        return response()->json($data, $this->getStatusCode(), $headers);
    }
    public function respondCreated($message="Successfully created!")
    {
        return $this->setStatusCode(201)
                    ->respond([
                        'success'=>[
                            'message' => $message,
                            'status_code' => $this->getStatusCode()
                        ]
            		]);
    }

    /**
     * [respondWithError description]
     * @param  [type] $message [description]
     * @return [type]          [description]
     */
    public function respondWithError($message)
    {
        return $this->respond([
                'error'=>[
                    'message' => $message,
                    'status_code' => $this->getStatusCode()
                ]
            ]);
    }

    public function responseValidationError()
    {
    	return $this->setStatusCode(422)->respondWithError($this->getValidationErrors());
    }

    /**
     * Gets the value of statusCode.
     *
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Sets the value of statusCode.
     *
     * @param mixed $statusCode the status code
     *
     * @return self
     */
    protected function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * Gets the value of validation_errors.
     *
     * @return mixed
     */
    public function getValidationErrors()
    {
        return $this->validation_errors;
    }

    /**
     * Sets the value of validation_errors.
     *
     * @param mixed $validation_errors the validation errors
     *
     * @return self
     */
    protected function setValidationErrors($validation_errors)
    {
        $this->validation_errors = $validation_errors;

        return $this;
    }

    /**
     * validates a request object with a given set of rules
     * @param  array   $rules 
     * @return boolean        
     */
    public function isValidated(array $rules)
    {
    	$validator = Validator::make($this->getRequest()->all(), $rules);
        if (!$validator->fails()) {
        	return true;
        }
		$this->setValidationErrors($validator->errors());
    }

    /**
     * Gets the value of request.
     *
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Sets the value of request.
     *
     * @param mixed $request the request
     *
     * @return self
     */
    protected function setRequest($request)
    {
        $this->request = $request;

        return $this;
    }
}

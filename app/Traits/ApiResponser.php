<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\MessageBag;

trait ApiResponser {

	protected function apiResponse($message = null, $messages = array(), $data = array(), $code, $status) {

		$response = $this->setResponseFormat($message, $messages, $data, $status);

		return response()->json($response, $code);
	}
	
    protected function setResponseFormat($message = null, $messages = array(), $data =  array(), $status) {

    	$messages = $this->setErrors($messages);

    	if(empty($data)) {
    		$data = new \stdClass;
    	}

    	return [
    		'status' => $status,
    		'message' => $message,
            'errors' => $messages,
            'data' => $data
    	];
    }

    protected function setErrors($errors = array())
    {
    	$messages = array();
    	$errors = new MessageBag($errors);
    	/* convert to single array as required by api user */
    	foreach($errors->getMessages() as $error) {
    		
    		foreach($error as $e) {
    			$messages[] = $e;
    		}
    	}

    	return $messages;
    }
}
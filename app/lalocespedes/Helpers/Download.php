<?php

namespace lalocespedes\Helpers;

/**
* 
*/
class Download
{

	protected $response;

	protected $file;

	protected $data;

	public function __construct($response)
	{
		$this->response =  $response;
	}

	public function force($file, $data)
	{

		if ($file == '' OR $data == '')
		{
			return FALSE;
		}

		$this->response->headers->set('Content-Description','File Transfer');
	    $this->response->headers->set('Content-Type','application/octet-stream');
	    $this->response->headers->set('Content-Disposition','attachment; filename="'.basename($file).'"');
	    $this->response->headers->set('Content-Transfer-Encoding','binary');
	    $this->response->headers->set('Connection','Keep-Alive');
	    $this->response->headers->set('Expires',' 0');
	    $this->response->headers->set('Cache-Control', 'must-revalidate');
	    $this->response->headers->set('Pragma','no-cache');
	    $this->response->headers->set('Content-Length', ''.strlen($data)).'';
	}

}
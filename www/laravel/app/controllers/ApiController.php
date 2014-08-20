<?php

use Illuminate\Http\Response as IlluminateResponse; // This prevents naming conflict with the BaseController
use Illuminate\Pagination\Paginator;

class ApiController extends \BaseController {
	protected $statusCode = 200;

	public function getStatusCode() {
		return $this->statusCode;
	}

	public function setStatusCode($statusCode) {
		$this->statusCode = $statusCode;
		return $this;
	}

	public function respondCreated($data) {
		$this->setStatusCode(IlluminateResponse::HTTP_CREATED)->respond($data);
	}

	public function respondUnprocessable($message = "http.Unprocessable") {
		return $this->setStatusCode(IlluminateResponse::HTTP_UNPROCESSABLE_ENTITY)->respondWithError(trans($message));
	}

	public function respondForbidden($message = "http.Forbidden") {
		return $this->setStatusCode(IlluminateResponse::HTTP_FORBIDDEN)->respondWithError(trans($message));
	}

	public function respondNotFound($message = "http.Not_found") {
		return $this->setStatusCode(IlluminateResponse::HTTP_NOT_FOUND)->respondWithError(trans($message));
	}

	public function respond($data, $headers = []) {
		return Response::json($data, $this->getStatusCode(), $headers);
	}

	public function respondWithError($message) {
		return $this->respond([
			'error' => [
				'message'	=> $message,
				'status_code'	=> $this->getStatusCode()
			]
		]);
	}

	public function respondWithPagination(Paginator $paginator, $data)
	{
		return $this->respond(array_merge($data, [
			'positioning' => [
				'total_records' => $paginator->getTotal(),
				'total_pages'   => ceil($paginator->getTotal() / $paginator->getPerPage()),
				'current_page'  => $paginator->getCurrentPage(),
				'limit'         => $paginator->getPerPage()
			]
		]));
	}
}

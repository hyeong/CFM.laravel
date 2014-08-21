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
		return $this->setStatusCode(IlluminateResponse::HTTP_CREATED)->respond($data);
	}

	public function respondGone($message = "http.Gone") {
		return $this->setStatusCode(IlluminateResponse::HTTP_GONE)->respondWithError($message);
	}

	public function respondBadRequest($message = "http.Bad_request") {
		return $this->setStatusCode(IlluminateResponse::HTTP_BAD_REQUEST)->respondWithError($message);
	}

	public function respondUnprocessable($message = "http.Unprocessable") {
		return $this->setStatusCode(IlluminateResponse::HTTP_UNPROCESSABLE_ENTITY)->respondWithError($message);
	}

	public function respondForbidden($message = "http.Forbidden") {
		return $this->setStatusCode(IlluminateResponse::HTTP_FORBIDDEN)->respondWithError($message);
	}

	public function respondNotFound($message = "http.Not_found") {
		return $this->setStatusCode(IlluminateResponse::HTTP_NOT_FOUND)->respondWithError($message);
	}

	public function respond($data, $headers = []) {
		return Response::json($data, $this->getStatusCode(), $headers);
	}

	public function respondWithError($message) {
		if (is_array($message)) {
			$final_messages = [];
			foreach ($message as $entry) {
				$final_messages[] = trans($message);
			}
		} else {
			$final_messages = [trans($message)];
		}
		return $this->respond([
			'error' => [
				'messages'	=> $final_messages,
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

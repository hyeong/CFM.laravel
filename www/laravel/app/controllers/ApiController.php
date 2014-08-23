<?php

use Illuminate\Http\Response as IlluminateResponse; // This prevents naming conflict with the BaseController
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent as Eloquent;

abstract class ApiController extends \BaseController {
	protected $statusCode = 200;
	protected $transformer;
	protected $model;

	/**
	 * An index method. This will be called whenever the controller@index
	 * method is called (which usually is when the model member is called
	 * in the HTTP request, without a specific ID) and will automatically
	 * paginate to 25, but with a maximum of 250 and a minimum of 1 record.
	 *
	 * GET /<items>/
	 *
	 * return Respond
	 */
        public function index()
        {
                $limit = Input::get('limit', 25); // If the limit isn't set, make it 25
                $limit = $limit > 250 ? 250 : $limit; // If the limit is greater than 250, make it 250
		$limit = $limit < 1 ? 1 : $limit; // If the limit is less than 1, ignore it.
                $data = $this->model->paginate($limit);
                return $this->respondWithPagination($data, [
                        'data' => $this->transformer->transformCollection($data->all())
                ]);
        }

	/**
	 * This method is called when a new object is requested to be stored.
	 * It passes the value off to be validated in the model, and then, if
	 * it's OK, will create it.
	 *
	 * POST /<items>/
	 * RETURN {'id': 1, 'other': 'data', 'may': 'appear'}
	 *
	 * @return Respond
	 */
        public function store()
        {
                if (! $this->model->fill(Input::all())->checkFormatting()->isValid()) {
                        return $this->respondUnprocessable($this->model->errors);
                }
                $this->model->save();
                return $this->respondCreated($this->transformer->transform($this->model));
        }

	/**
	 * This method is called when requesting a single row of data from the 
	 * model. This data should be indexable via the id row.
	 *
	 * GET /<items>/{$id}
	 * RETURN {'id': 1, 'other': 'data', 'may': 'appear'}
	 *
	 * @param integer $id The row to find.
	 *
	 * @return Respond
	 */
        public function show($id)
        {
                try {
                        return ['data' => $this->transformer->transform($this->model->findOrFail($id))];
                } catch (Eloquent\ModelNotFoundException $exception) {
                        return $this->respondNotFound();
                }
        }

	/**
	 * This method is triggered when a DELETE request is received. It
	 * checks whether the ID exists and returns either a 404, a 410 or 400
	 * depending on whether it can delete the record.
	 *
	 * DELETE /<items>/{$id}
	 *
	 * @param integer $id The row to find.
	 *
	 * @return Respond
	 */
        public function destroy($id)
        {
                try {
                        return $this->model->findOrFail($id)->delete() ? $this->respondGone() : $this->respondBadRequest();
                } catch (Eloquent\ModelNotFoundException $exception) {
                        return $this->respondNotFound();
                }
        }

        /**
         * Update the specified resource in storage.
	 *
         * PUT /<item>/{id}
         *
         * @param  int  $id
         *
         * @return Response
         */
        public function update($id)
        {
                //
        }

        /**
         * Show the form for editing the specified resource.
         *
         * GET /<item>/{id}/edit
         *
         * @param  int  $id
	 *
         * @return Response
         */
        public function edit($id)
        {
                //
        }

        /**
         * Show the form for creating a new resource.
         *
         * GET /<item>/create
         *
         * @return Response
         */
        public function create()
        {
                //
        }

	/**
	 * This method returns the defined HTTP Status Code for this request
	 *
	 * @return integer
	 */
	public function getStatusCode() {
		return $this->statusCode;
	}

	/**
	 * This method sets the HTTP Status Code for this request
	 *
	 * @param integer $statusCode
	 *
	 * @return ApiController
	 */
	public function setStatusCode($statusCode) {
		$this->statusCode = $statusCode;
		return $this;
	}

	/**
	 * This method adds pagination data to the returning data so that
	 * a consumer of that data knows where to point next for additional
	 * pages of data.
	 *
	 * @param Paginator $paginator The model object, via the Paginate
	 * method
	 * @param array     $data      The data, encapsulated in an array,
	 * to be sent back to the consumer
	 *
	 * @return Respond
	 */
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

	/**
	 * This method returns a common HTTP Created (201) response,
	 * including the data to be returned as part of that response.
	 *
	 * @param array $data The data to send back
	 *
	 * @return Respond
	 */
	public function respondCreated($data) {
		return $this->setStatusCode(IlluminateResponse::HTTP_CREATED)->respond($data);
	}

	/**
	 * This method returns a common HTTP Gone (410) response,
	 * including the message to be returned as part of that response.
	 *
	 * If the message is an array, the "respond" method will step over
	 * each entry and try to translate them using the trans() function.
	 *
	 * @param string[] $message The data to send back
	 *
	 * @return Respond
	 */
	public function respondGone($message = "http.Gone") {
		return $this->setStatusCode(IlluminateResponse::HTTP_GONE)->respondWithError($message);
	}

	/**
	 * This method returns a common HTTP Bad Request (400) response,
	 * including the message to be returned as part of that response.
	 *
	 * If the message is an array, the "respond" method will step over
	 * each entry and try to translate them using the trans() function.
	 *
	 * @param string[] $message The data to send back
	 *
	 * @return Respond
	 */
	public function respondBadRequest($message = "http.Bad_request") {
		return $this->setStatusCode(IlluminateResponse::HTTP_BAD_REQUEST)->respondWithError($message);
	}

	/**
	 * This method returns a common HTTP Unprocessable (422) response,
	 * including the message to be returned as part of that response.
	 *
	 * If the message is an array, the "respond" method will step over
	 * each entry and try to translate them using the trans() function.
	 *
	 * @param string[] $message The data to send back
	 *
	 * @return Respond
	 */
	public function respondUnprocessable($message = "http.Unprocessable") {
		return $this->setStatusCode(IlluminateResponse::HTTP_UNPROCESSABLE_ENTITY)->respondWithError($message);
	}

	/**
	 * This method returns a common HTTP Forbidden (403) response,
	 * including the message to be returned as part of that response.
	 *
	 * If the message is an array, the "respond" method will step over
	 * each entry and try to translate them using the trans() function.
	 *
	 * @param string[] $message The data to send back
	 *
	 * @return Respond
	 */
	public function respondForbidden($message = "http.Forbidden") {
		return $this->setStatusCode(IlluminateResponse::HTTP_FORBIDDEN)->respondWithError($message);
	}

	/**
	 * This method returns a common HTTP Not Found (404) response,
	 * including the message to be returned as part of that response.
	 *
	 * If the message is an array, the "respond" method will step over
	 * each entry and try to translate them using the trans() function.
	 *
	 * @param string[] $message The data to send back
	 *
	 * @return Respond
	 */
	public function respondNotFound($message = "http.Not_found") {
		return $this->setStatusCode(IlluminateResponse::HTTP_NOT_FOUND)->respondWithError($message);
	}

	/**
	 * This method wraps the various respond* functions so they send data
	 * consistently. It can be chained through the setStatusCode(integer)
	 * method to be verbose in it's sending of RESTful responses.
	 *
	 * @param array $data    The data to be sent
	 * @param array $headers Any additional headers to be sent
	 *
	 * @return Respond
	 */
	public function respond($data, $headers = []) {
		return Response::json($data, $this->getStatusCode(), $headers);
	}

	/**
	 * This method takes any error messages, translates them using an
	 * appropriate handler, adds the status code metadata to it
	 * and then packages it up as an array to send to the respond-as-json
	 * function above.
	 *
	 * @param string[]|string $message The string(s) to send back.
	 * The ambiguity is down to the fact that the respondWithError may
	 * be triggered by multiple validation errors.
	 *
	 * @return Respond
	 */
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

}

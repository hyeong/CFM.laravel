<?php

use CampFireManager\Transformers\TalkTransformer;
use Illuminate\Database\Eloquent as Eloquent;

class TalkController extends ApiController {
	/**
	 * @var CampFireManager\Transformers\TalkTransformer
	 */
	protected $TalkTransformer;

	public function __construct(TalkTransformer $TalkTransformer) {
		$this->TalkTransformer = $TalkTransformer;
		$this->beforeFilter('auth.basic', ['on' => 'post']);
	}

	/**
	 * Display a listing of the resource.
	 * GET /talk
	 *
	 * @return Response
	 */
	public function index()
	{
		$limit = Input::get('limit', 25); // If the limit isn't set, make it 25
		$limit = $limit > 250 ? 250 : $limit; // If the limit is greater than 250, make it 250
		$talks = Talk::paginate($limit);
		return $this->respondWithPagination($talks, [
			'data' => $this->TalkTransformer->transformCollection($talks->all())
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /talk/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /talk
	 *
	 * @return Response
	 */
	public function store()
	{
		// Content checking occurs here
		if (! Input::get('name')) {
			return $this->respondUnprocessable('talk.name not provided');
		}
		$talk = Talk::create(Input::all());
		return $this->respondCreated($this->TalkTransformer->transform($talk));
	}

	/**
	 * Display the specified resource.
	 * GET /talk/{id}
	 *
	 * @param  int  $id
	 *
	 * @return Response
	 *
	 * @exception Illuminate\Database\Eloquent\ModelNotFoundException When failing to find a record
	 */
	public function show($id)
	{
		try {
			return $this->TalkTransformer->transform(Talk::findOrFail($id));
		} catch (Eloquent\ModelNotFoundException $exception) {
			return $this->respondNotFound();
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /talk/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /talk/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /talk/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}

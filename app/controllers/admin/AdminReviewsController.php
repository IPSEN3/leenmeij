<?php

class AdminReviewsController extends AdminController
{

    /**
     * review Model
     * @var review
     */
    protected $review;

    /**
     * Inject the models.
     * @param review $review
     */
    public function __construct(Review $review)
    {
        parent::__construct();
        $this->review = $review;
    }

    /**
     * Show a list of all the review posts.
     *
     * @return View
     */
    public function getIndex()
    {
        // Title
        $title = Lang::get('admin/reviews/title.review_management');

        // Grab all the review posts
        $reviews = $this->review;

        // Show the page
        return View::make('admin/reviews/index', compact('reviews', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $review
     * @return Response
     */
    public function getEdit($review)
    {
        // Title
        $title = Lang::get('admin/reviews/title.review_update');

        // Show the page
        return View::make('admin/reviews/edit', compact('review', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $review
     * @return Response
     */
    public function postEdit($review)
    {
        // Declare the rules for the form validation
        $rules = array(
            'content' => 'required|min:3'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Update the review post data
            $review->content = Input::get('content');

            // Was the review post updated?
            if($review->save())
            {
                // Redirect to the new review post page
                return Redirect::to('admin/reviews/' . $review->id . '/edit')->with('success', Lang::get('admin/reviews/messages.update.success'));
            }

            // Redirect to the reviews post management page
            return Redirect::to('admin/reviews/' . $review->id . '/edit')->with('error', Lang::get('admin/reviews/messages.update.error'));
        }

        // Form validation failed
        return Redirect::to('admin/reviews/' . $review->id . '/edit')->withInput()->withErrors($validator);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $review
     * @return Response
     */
    public function getDelete($review)
    {
        // Title
        $title = Lang::get('admin/reviews/title.review_delete');

        // Show the page
        return View::make('admin/reviews/delete', compact('review', 'title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $review
     * @return Response
     */
    public function postDelete($review)
    {
        // Declare the rules for the form validation
        $rules = array(
            'id' => 'required|integer'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            $id = $review->id;
            $review->delete();

            // Was the review post deleted?
            $review = review::find($id);
            if(empty($review))
            {
                // Redirect to the review posts management page
                return Redirect::to('admin/reviews')->with('success', Lang::get('admin/reviews/messages.delete.success'));
            }
        }
        // There was a problem deleting the review post
        return Redirect::to('admin/reviews')->with('error', Lang::get('admin/reviews/messages.delete.error'));
    }

    /**
     * Show a list of all the reviews formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {

        $reviews = Review::select('*');

        // $reviews = Review::leftjoin('posts', 'posts.id', '=', 'reviews.post_id')
        //                 ->leftjoin('users', 'users.id', '=','reviews.user_id' )
        //                 ->select(array('reviews.id as id', 'posts.id as postid','users.id as userid', 'reviews.content', 'posts.title as post_name', 'users.username as poster_name', 'reviews.created_at'));

        return Datatables::of($reviews)


        ->make();
    }

}

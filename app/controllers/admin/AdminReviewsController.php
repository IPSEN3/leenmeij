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

    public function postApproved($review) {

        Review::where('id', '=', $review->id)->update(array('approved' => 1));

        return Redirect::back()->with('notice', 'Review accepted');
    }

    public function postDisapproved($review) {

        Review::where('id', '=', $review->id)->update(array('approved' => 0));

        return Redirect::back()->with('notice', 'Review denied');
    }    

    public function missingMethod($parameters = array())
    {
        throw new Exception('missing method on ' . Request::path() . ' With request method ' . Request::server('REQUEST_METHOD'));
    }


    /**
     * Show a list of all the reviews formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {

        $reviews = Review::leftjoin('vehicle', 'vehicle.id', '=', 'reviews.vehicle_id')
                         ->leftjoin('users', 'users.id', '=','reviews.user_id' )
                         ->select(array('reviews.id as id', 'vehicle.id as vehicleid','users.id as userid', 'vehicle.brand as vehiclebrand', 'vehicle.type as vehicletype', 'users.username as poster_name', 'reviews.created_at', DB::raw('CASE WHEN approved = 1 THEN \'Ja\' ELSE \'Nee\' END AS approved')));

        return Datatables::of($reviews)

        ->add_column('actions', '<a href="{{{ URL::to(\'admin/reviews/\' . $id . \'/approved\' ) }}}" class="btn btn-success btn-xs">{{{ Lang::get(\'admin/reviews/table.approve\') }}}</a>
                <a href="{{{ URL::to(\'admin/reviews/\' . $id . \'/disapproved\' ) }}}" class="btn btn-xs btn-danger">{{{ Lang::get(\'admin/reviews/table.disapprove\') }}}</a>
            ')

        ->remove_column('vehicleid')
        ->remove_column('userid')

        ->make();
    }

}

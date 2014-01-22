<?php
 
class Review extends Eloquent {
  
  public function user()
  {
    return $this->belongsTo('User');
  }
 
  public function vehicle()
  {
    return $this->belongsTo('Vehicle');
  }
 
  public function scopeApproved($query)
  {
    return $query->where('approved', true);
  }
 
  public function scopeSpam($query)
  {
    return $query->where('spam', true);
  }
 
  public function scopeNotSpam($query)
  {
    return $query->where('spam', false);
  }

  public function getTimeagoAttribute()
  {
    $date = Carbon::createFromTimeStamp(strtotime($this->created_at))->diffForHumans();
    return $date;
  }

  public function getCreateRules() 
  {
      $rules = array(
        'comment' => 'required',
        'rating' => 'required',
        );

      return $rules;
  }

  public function storeReviewForProduct($vehicleID, $comment, $rating)
  {
    $vehicle = Vehicle::find($vehicleID);
   
    // this will be added when we add user's login functionality
    $this->user_id = Auth::user()->id;
    $this->comment = $comment;
    $this->rating = $rating;
    $vehicle->reviews()->save($this);
   
    // recalculate ratings for the specified vehicle
    $vehicle->recalculateRating($rating);
  }

}
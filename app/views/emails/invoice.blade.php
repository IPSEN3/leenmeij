<div class="container">

                <div class="row">
                        <div class="col-xs-6">
                        </div>
                        <div class="col-xs-6 text-right">
                          <h1>INVOICE</h1>
                          <h1><small>Invoice #{{ $naw->birthdate }}</small></h1>
                        </div>
                </div>

                  <div class="row">
                    <div class="col-xs-5">
                      <div class="panel panel-default">
                              <div class="panel-heading">
                                <h4>From: <a href="#">Leenmeij</a></h4>
                              </div>
                              <div class="panel-body">
                                <p>
                                  Zijldijk 130 <br>
                                  2352BA Leiden <br>
                                  info@leenmeij.com <br>
                                  071-7503299<br>
                                </p>
                              </div>
                            </div>
                    </div>
                    <div class="col-xs-5 col-xs-offset-2 text-right">
                      <div class="panel panel-default">
                              <div class="panel-heading">
                                <h4>To : <a href="#">{{Auth::user()->username}}</a></h4>
                              </div>
                              <div class="panel-body">
                                <p>
                                  {{ $naw->address }} <br>
                                  {{ $naw->zip }} <br>
                                  {{ $naw->city }} <br>
                                </p>
                              </div>
                            </div>
                    </div>
                  </div> <!-- / end client details section -->

                         <table class="table table-bordered">
        <thead>
          <tr>
            <th><h4>Van</h4></th>
            <th><h4>Tot</h4></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{ $reservation['pickupdate'] }}</td>
            <td>{{ $reservation['returndate'] }}</td>
          </tr>
        </tbody>
      </table>

        </div>
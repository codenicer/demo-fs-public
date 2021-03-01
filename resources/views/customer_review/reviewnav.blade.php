<div class="col">
  {{-- {{dd()}} --}}
    <h4 class="font-weight-bold">{{_('My Reviews')}}</h4>
    <div class="row" >
        <ul class="nav">
            <li class="nav-item">
            <a class="nav-link active" style="{{request()->getRequestUri() == "/myreviews" ? " text-decoration: underline" : null}}" href="{{route('myreview')}}">
                  <h6 class="font-weight-bold">To Be Review</h6>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link font-weight-bold" style="{{request()->getRequestUri() != "/myreviews" ? " text-decoration: underline" : null}}"  href="{{route('myreview.history')}}">
                  <h6 class="font-weight-bold">History</h6>
              </a>
            </li>
          </ul>
    </div>


<div class="review-block">
    @forelse  ($reviews as $review)
    <div class="p-2">
        <div class="d-flex flex-column align-items-center">
            <div class="d-flex align-self-start mb-2">
                <div class="star-rating">
                  {{ renderStarRating($review->rating) }}
                </div>
                <span class='strong ml-2'>{{$review->rating}}/ 5</span>
            </div>
            <div class='d-flex flex-column w-100'>
                <span>{{$review->comment}}</span>
                <span style="" class="blockquote-footer">Reviewed by<cite title="Source Title">  {{$review->user_id == null ? $review->full_name : "Anonymous"}}</cite></span>
            </div>
        </div>
    </div>
    <hr/>
    @empty
    <h6>No Review yet.</h6>
    @endforelse
</div>
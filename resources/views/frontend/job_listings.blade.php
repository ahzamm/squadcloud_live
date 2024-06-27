<ul class="cat-list">
    <li><a href="#" class="filter-button" data-employment-type="recent">Recent</a></li>
    <li><a href="#" class="filter-button" data-employment-type="Full Time">Full Time</a></li>
    <li><a href="#" class="filter-button" data-employment-type="Intern">Intern</a></li>
    <li><a href="#" class="filter-button" data-employment-type="Part Time">Part Time</a></li>
</ul>
@foreach ($jobs as $job)
<div class="single-post d-flex flex-row">
    <div class="thumb">
        <img src="{{ asset('frontend_assets/images/jobs/'. $job->image) }}" width="120" height="60">
        <ul class="tags">
            @foreach (explode(',', $job->tags) as $tag)
                <li>
                    <a href="#">{{$tag}}</a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="details">
        <div class="title d-flex flex-row justify-content-between">
            <div class="titles">
                <a href="#"><h4>{{$job->job_title}}</h4></a>
                <h6>Premium Labels Limited</h6>
            </div>
            <ul class="btns">
                    <li><a href="#"><span class="lnr lnr-heart"></span></a></li>
                    <li><a href="#">Apply</a></li>
            </ul>
        </div>
        <p>
            {!!$job->job_description!!}
        </p>
        <h5>Job Nature: {{$job->employment_type}}</h5>
        <p class="address"><span class="lnr lnr-map"></span> {{$job->location}}</p>
        <p class="address"><span class="lnr lnr-database"></span> {{$job->salary_range}}</p>
    </div>
</div>
@endforeach

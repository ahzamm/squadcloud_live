<style>
    .modal-content {
      background-color: #fefefe;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .modal-header, .modal-body {
      padding: 10px 20px;
    }

    .modal-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid #ddd;
    }

    .modal-title {
      font-size: 1.5em;
      margin: 0;
    }

    .close {
      background: none;
      border: none;
      font-size: 1.5em;
      cursor: pointer;
    }

    .form-group {
      margin-bottom: 1.5em;
    }

    .form-group label {
      display: block;
      margin-bottom: 0.5em;
      font-weight: bold;
    }

    .form-group input, .form-group textarea {
      width: 100%;
      padding: 0.5em;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .btn-primary {
      display: inline-block;
      padding: 0.5em 1em;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      float: right;
    }

    .btn-primary:hover {
      background-color: #0056b3;
    }
  </style>

  <ul class="cat-list">
    <li><a href="" class="filter-button" data-employment-type="View All">View All</a></li>
    <li><a href="" class="filter-button" data-employment-type="Full Time">Full Time</a></li>
    <li><a href="" class="filter-button" data-employment-type="Intern">Intern</a></li>
    <li><a href="" class="filter-button" data-employment-type="Part Time">Part Time</a></li>
  </ul>
  @foreach ($jobs as $job)
    <div class="single-post d-flex flex-row">
      <div class="thumb">
        <ul class="tags">
          @foreach (explode(',', $job->tags) as $tag)
            <li><a>{{ $tag }}</a></li>
          @endforeach
        </ul>
      </div>
      <div class="details">
        <div class="title d-flex flex-row justify-content-between">
          <div class="titles">
            <a>
              <h4>{{ $job->job_title }}</h4>
            </a>
            <h6>{{ $job->company }}</h6>
          </div>
          <ul class="btns">
            <li><a href="javascript:void(0);" class="apply-button" data-job-id="{{ $job->id }}" onclick="showModal({{ $job->id }})">Apply Now</a></li>
          </ul>
        </div>
        <p>
          {!! $job->job_description !!}
        </p>
        <p><i class="fa fa-copy"></i> Job Nature: {{ $job->employment_type }}</p>
        <p class="address"><i class="fa fa-map-marker-alt"></i> {{ $job->location }}</p>
        <p class="address"><i class="fa fa-money-bill-alt"></i> {{ $job->salary_range }}</p>
      </div>
    </div>
  @endforeach

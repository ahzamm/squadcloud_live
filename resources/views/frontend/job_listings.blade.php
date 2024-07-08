<style>
    /* Custom CSS for modal */
    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
      background-color: #fefefe;
      margin: 10% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
      max-width: 600px;
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
            <li><a href="#" class="apply-button" data-toggle="modal" data-target="#applyModal">Apply</a></li>
          </ul>
        </div>
        <p>
          {!! $job->job_description !!}
        </p>
        <h5>Job Nature: {{ $job->employment_type }}</h5>
        <p class="address"><span class="lnr lnr-map"></span> {{ $job->location }}</p>
        <p class="address"><span class="lnr lnr-database"></span> {{ $job->salary_range }}</p>
      </div>
    </div>
  @endforeach

  <!-- Modal -->
  <div class="modal" id="applyModal">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="applyModalLabel">Apply for Job</h5>
        <button type="button" class="close" onclick="document.getElementById('applyModal').style.display='none'">&times;</button>
      </div>
      <div class="modal-body">
        <form id="applyForm" action="{{ route('site.career.post') }}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="form-group">
            <label for="applicant-name">Name</label>
            <input type="text" id="applicant-name" name="name" required>
          </div>
          <div class="form-group">
            <label for="applicant-email">Email</label>
            <input type="email" id="applicant-email" name="email" required>
          </div>
          <div class="form-group">
            <label for="applicant-phone">Phone</label>
            <input type="tel" id="applicant-phone" name="phone" required>
          </div>
          <div class="form-group">
            <label for="applicant-coverletter">Cover Letter</label>
            <textarea id="applicant-coverletter" name="coverletter" rows="3" required></textarea>
          </div>
          <div class="form-group">
            <label for="applicant-resume">Resume (PDF)</label>
            <input type="file" id="applicant-resume" name="resume" accept=".pdf" required>
          </div>
          <button type="submit" class="btn-primary">Submit Application</button>
        </form>
      </div>
    </div>
  </div>

  <script>
    // Show modal
    document.querySelectorAll('.apply-button').forEach(button => {
      button.addEventListener('click', () => {
        document.getElementById('applyModal').style.display = 'block';
      });
    });

    // Hide modal when clicking outside of it
    window.addEventListener('click', event => {
      const modal = document.getElementById('applyModal');
      if (event.target === modal) {
        modal.style.display = 'none';
      }
    });
  </script>

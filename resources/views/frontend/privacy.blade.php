@extends('layouts/frontend')
@section('page_title', 'Privacy Policy - SquadCloud')
@section('home_select', 'active')
@section('content')

  <style>
    header#main-header {
      background: rgb(100, 5, 15) !important;
    }

    section#policy-section {
      padding-top: 100px;
      padding-bottom: 100px;
      background-color: #f4f4f4;
      
    }

    .policy-container {
      display: flex;
      max-width: 1200px;
      width: 100%;
      margin: auto;
    }

    .sidebar {
      flex: 0 0 250px;
      position: sticky;
      top: 100px;
      background: #fff;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      height: fit-content;
    }

    .sidebar h2 {
      font-size: 1.2rem;
      color: #333;
      margin-bottom: 20px;
    }

    .sidebar a {
      display: block;
      color: #333;
      margin-bottom: 10px;
      text-decoration: none;
      transition: color 0.3s ease;
      padding-left: 10px;
    }

    .sidebar a.active {
      color: #b30000;
      font-weight: bold;
    }

    .sidebar .child-link {
      padding-left: 20px;
    }

    .content {
      flex: 1;
      margin-left: 30px;
      background: #fff;
      border-radius: 10px;
      padding: 40px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .content h1 {
      color: #b30000;
      font-size: 2.5rem;
      margin-bottom: 30px;
      text-align: center;
      font-weight: bold;
    }

    .content h2,
    .content h3,
    .content h4,
    .content h5,
    .content h6 {
      color: #b30000;
      margin-top: 30px;
      margin-bottom: 15px;
      font-weight: bold;
    }

    .content p {
      color: #333;
      line-height: 1.8;
      margin-bottom: 20px;
      text-align: justify;
    }

    .content img {
      display: block;
      margin: 30px auto;
      max-width: 100%;
      border-radius: 10px;
    }
    @media (max-width: 768px) {
      .sidebar {
        display: none;
      }
      section#policy-section {
        padding-bottom: 30px;
      }
      .policy-container .content {
        margin: 0;
        padding: 20px;
      }
    }
  </style>

  <section id="policy-section">
  <div class="container">
      <div class="title-img d-flex align-items-center justify-content-center flex-column mb-3 aos-init aos-animate" data-aos="zoom-in-down">
        @if ($privacy->title_image)
          <img src="frontend_assets/images/title/{{ $privacy->title_image }}" alt="Privacy Policy Image" style=" width:50%">
        @endif
      </div>
    </div>
    <div class="policy-container">
      <div class="sidebar" id="sidebar">
        <h2>Privacy Policy</h2>
        <!-- Sidebar links will be dynamically added here -->
      </div>
      <div class="content" id="policy-content">
       
        {!! $privacy->privacy !!}
      </div>
    </div>
  </section>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const policyContent = document.getElementById('policy-content');
      const sidebar = document.getElementById('sidebar');
      const headings = policyContent.querySelectorAll('h2, h3, h4, h5, h6');
      const navLinks = [];

      headings.forEach((heading, index) => {
        const id = 'section-' + index;
        heading.setAttribute('id', id);
        const link = document.createElement('a');
        link.setAttribute('href', '#' + id);
        link.textContent = heading.textContent;
        link.classList.add(heading.tagName.toLowerCase() + '-link');
        if (heading.tagName === 'H2') {
          link.classList.add('main-link');
        } else {
          link.classList.add('child-link');
        }
        sidebar.appendChild(link);
        navLinks.push(link);
      });

      window.addEventListener('scroll', () => {
        let current = '';
        headings.forEach(section => {
          const sectionTop = section.offsetTop - 110;
          if (window.scrollY >= sectionTop) {
            current = section.getAttribute('id');
          }
        });

        navLinks.forEach(link => {
          link.classList.remove('active');
          if (link.getAttribute('href').includes(current)) {
            link.classList.add('active');
          }
        });
      });
    });
  </script>

@endsection

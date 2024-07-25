@extends('layouts/frontend')
@section('page_title', 'FAQs - SquadCloud')
@section('home_select', 'active')
@section('content')

  <style>
    header#main-header {
      background: rgb(100, 5, 15) !important;
    }

    section#faq-section {
      padding-top: 100px;
      padding-bottom: 50px;
      background-color: #f8f8f8;
    }

    .faq-title {
      color: #b30000;
      font-size: 2.5rem;
      margin-bottom: 40px;
      text-align: center;
    }

    .faq-item {
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 20px;
      margin-bottom: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      transition: box-shadow 0.3s ease;
    }

    .faq-item:hover {
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .faq-question {
      color: #b30000;
      font-size: 1.25rem;
      font-weight: 600;
      margin-bottom: 10px;
    }

    .faq-answer {
      color: #333;
      font-size: 1rem;
      line-height: 1.6;
    }

    .faq-nav {
      flex-direction: column;
      margin: 0 0 32px;
      border-radius: 2px;
      border: 1px solid #ddd;
      box-shadow: 0 1px 5px rgba(85, 85, 85, 0.15);
    }

    .faq-nav .nav-link {
      position: relative;
      display: block;
      margin: 0;
      padding: 13px 16px;
      background-color: #fff;
      border: 0;
      border-bottom: 1px solid #ddd;
      border-radius: 0;
      color: #616161;
      transition: background-color 0.2s ease;
    }

    .faq-nav .nav-link:hover {
      background-color: #f6f6f6;
    }

    .faq-nav .nav-link.active {
      background-color: #f6f6f6;
      font-weight: 700;
      color: rgba(0, 0, 0, 0.87);
    }

    .faq-nav .nav-link:last-of-type {
      border-bottom-left-radius: 2px;
      border-bottom-right-radius: 2px;
      border-bottom: 0;
    }

    .faq-nav .nav-link i.mdi {
      margin-right: 5px;
      font-size: 18px;
      position: relative;
    }

    .tab-content {
      box-shadow: 0 1px 5px rgba(85, 85, 85, 0.15);
    }

    .tab-content .card {
      border-radius: 0;
    }

    .tab-content .card-header {
      padding: 15px 16px;
      border-radius: 0;
      background-color: #f6f6f6;
    }

    .tab-content .card-header h5 {
      margin: 0;
    }

    .tab-content .card-header h5 button {
      display: block;
      width: 100%;
      padding: 0;
      border: 0;
      font-weight: 700;
      color: rgba(0, 0, 0, 0.87);
      text-align: left;
      white-space: normal;
    }

    .tab-content .card-header h5 button:hover,
    .tab-content .card-header h5 button:focus,
    .tab-content .card-header h5 button:active,
    .tab-content .card-header h5 button:hover:active {
      text-decoration: none;
    }

    .tab-content .card-body p {
      color: #616161;
    }

    .tab-content .card-body p:last-of-type {
      margin: 0;
    }

    .accordion>.card:not(:first-child) {
      border-top: 0;
    }

    .collapse.show .card-body {
      border-bottom: 1px solid rgba(0, 0, 0, 0.125);
    }
  </style>

  <section id="faq-section" class="position-relative">
    <div class="container">
      <div class="title-img d-flex align-items-center justify-content-center flex-column mb-5" data-aos="zoom-in-down">
      
        <img src="frontend_assets/images/title/{{ $title_image }}" alt="" style="width: 50%;">
      </div>
      <div class="row">
        <div class="col-lg-4">
          <div class="nav nav-pills faq-nav" id="faq-tabs" role="tablist" aria-orientation="vertical">
            @foreach ($faq_categories as $index => $category)
              <a href="#tab{{ $category->id }}" class="nav-link {{ $index == 0 ? 'active' : '' }}" data-bs-toggle="pill" role="tab" aria-controls="tab{{ $category->id }}"
                aria-selected="{{ $index == 0 ? 'true' : 'false' }}">
                <i class="mdi mdi-help-circle"></i> {{ $category->category }}
              </a>
            @endforeach
          </div>
        </div>
        <div class="col-lg-8">
          <div class="tab-content" id="faq-tab-content">
            @foreach ($faq_categories as $index => $category)
              <div class="tab-pane {{ $index == 0 ? 'show active' : '' }}" id="tab{{ $category->id }}" role="tabpanel" aria-labelledby="tab{{ $category->id }}">
                <div class="accordion" id="accordion-tab-{{ $category->id }}">
                  @foreach ($category->faqs as $faq)
                    <div class="card">
                      <div class="card-header" id="accordion-tab-{{ $category->id }}-heading-{{ $faq->id }}">
                        <h5>
                          <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-tab-{{ $category->id }}-content-{{ $faq->id }}" aria-expanded="false"
                            aria-controls="accordion-tab-{{ $category->id }}-content-{{ $faq->id }}">
                            {!! $faq->question !!}
                          </button>
                        </h5>
                      </div>
                      <div class="collapse {{ $loop->first ? 'show' : '' }}" id="accordion-tab-{{ $category->id }}-content-{{ $faq->id }}"
                        aria-labelledby="accordion-tab-{{ $category->id }}-heading-{{ $faq->id }}" data-bs-parent="#accordion-tab-{{ $category->id }}">
                        <div class="card-body">
                          {!! $faq->answer !!}
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection

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
  </style>

  <section id="faq-section" class="position-relative">
    <div class="container">
      <h1 class="faq-title">Frequently Asked Questions</h1>
      <div class="faq-content">
        @foreach ($faqs as $faq)
          <div class="faq-item">
            <div class="faq-question">{!! $faq->question !!}</div>
            <div class="faq-answer">{!! $faq->answer !!}</div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

@endsection

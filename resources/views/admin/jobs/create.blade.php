@extends('admin.layouts.app')
@section('content')
<style>
    body {
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f4f4f4;
    }
    .tag-container {
        display: flex;
        flex-wrap: wrap;
        padding: 5px;
        width: 300px;
        border: 1px solid #ccc;
        background-color: #fff;
        border-radius: 5px;
    }
    .tag-container input {
        flex-grow: 1;
        border: none;
        outline: none;
        padding: 5px;
        font-size: 16px;
    }
    .tag {
        display: inline-flex;
        align-items: center;
        padding: 5px 10px;
        margin: 2px;
        background-color: #007bff;
        color: #fff;
        border-radius: 3px;
        position: relative;
    }
    .tag:nth-child(odd) {
        background-color: #28a745;
    }
    .tag .close {
        display: none;
        margin-left: 8px;
        cursor: pointer;
        font-weight: bold;
    }
    .tag:hover .close {
        display: inline;
    }
</style>
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info mt-2">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><span><i class="fa-solid fa-box-open"></i></span> Add Vacancy</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="{{route('jobs.index')}}">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
          <form id="jobForm" action="{{route('jobs.store')}}" method="POST" enctype="multipart/form-data">
            <div class="card-body pad">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Title <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="title" placeholder="Example : 15 Mbps" required value="{{old('title')}}">
                  </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Image <span style="color: red">*</span></label>
                      <input type="file" name="image">
                    </div>
                  </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">Description <span style="color: red">*</span></label>
                    <textarea name="description" rows="4" placeholder=""  class="form-control summernote">{{old('description')}}</textarea>
                  </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Location <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="location" placeholder="Example : 15 Mbps" required value="{{old('location')}}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="employment_type">Employement Type <span style="color: red">*</span></label>
                        <select class="form-control" id="employment_type" name="employment_type">
                            <option value="">Select Employement Type</option>
                            <option value="Full Time" {{ old('employment_type') == 'Full Time' ? 'selected' : '' }}>Full Time</option>
                            <option value="Part Time" {{ old('employment_type') == 'Part Time' ? 'selected' : '' }}>Part Time</option>
                            <option value="Intern" {{ old('employment_type') == 'Intern' ? 'selected' : '' }}>Intern</option>
                        </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Salary Range <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="salary_range" placeholder="Example : 15 Mbps" required value="{{old('salary_range')}}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="tag-container">
                        <input type="text" id="tag-input" placeholder="Add a tag and press Enter">
                        <input type="hidden" name="tags" id="tags">
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group clearfix">
                    <div class="icheck-success d-inline">
                      <input type="checkbox" {{old('is_active') != null? 'checked' :'unchecked' }} name="is_active" id="checkboxSuccess1">
                      <label for="checkboxSuccess1">
                        Status (On & Off)
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-outline-primary float-right">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
@push('scripts')
<script>
  $(document).ready(function() {
    $('#pageContent').summernote({
      height: 300
    });
  });
</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const tagContainer = document.querySelector('.tag-container');
        const input = document.getElementById('tag-input');
        const tagsInput = document.getElementById('tags');
        let tags = [];

        input.addEventListener('keydown', (event) => {
            if (event.key === 'Enter' && input.value.trim() !== '') {
                event.preventDefault();
                addTag(input.value);
                input.value = '';
            }
        });

        function addTag(tag) {
            const tagElement = document.createElement('span');
            tagElement.classList.add('tag');
            tagElement.textContent = tag;

            const closeIcon = document.createElement('span');
            closeIcon.classList.add('close');
            closeIcon.textContent = '×';
            closeIcon.addEventListener('click', () => {
                removeTag(tag);
                tagElement.remove();
            });

            tagElement.appendChild(closeIcon);
            tagContainer.insertBefore(tagElement, input);
            tags.push(tag);
            updateTagsInput();
        }

        function removeTag(tag) {
            tags = tags.filter(t => t !== tag);
            updateTagsInput();
        }

        function updateTagsInput() {
            tagsInput.value = tags.join(',');
        }

        document.getElementById('jobForm').addEventListener('submit', () => {
            updateTagsInput();
        });
    });
</script>
@endpush

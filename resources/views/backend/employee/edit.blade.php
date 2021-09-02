@extends('backend.layouts.app')

@section('title')
    employee Edit
@endsection

@section('css')
   
@endsection

@section('backend-content')

<div class="container mt-3">
    <div class="card">
        <div class="card-header">

            <h3 class="card-title">employee Edit</h3>

            <div class="container">
                <a href="{{ route('admin.employee.index') }}" class="btn btn-outline-info btn-sm float-right">
                   <i class="fas fa-plus-circle fa-w-20"></i><span> Back</span>
                </a>
            </div>
        </div>

        <div class="card-body">
    
            <form action="{{ route('admin.employee.update', $employee->id) }}" method="post" enctype="multipart/form-data">

                @method('PUT')
                @csrf


                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $employee->name }}" placeholder="Enter Name">
                </div>

                 <div class="form-group">
					<label for="image">Image</label> <br>
				
					<img src="{{  asset('frontend/images/employeeImage/' .$employee->image) }}" width="200" class="img-fluid mt-2" alt="{{ $employee->name }}" >
									
					<label class="col-md-12 col-from-label mt-5">New Image<span class="text-danger">*</span></label>
					<div class="col-md-12">
						<input type="file" class="form-control" name="image">
					</div>
				</div>

                <div class="form-group">
                    <label for="contact">Contact</label>
                    <input type="text" class="form-control" name="contact" value="{{ $employee->contact }}" placeholder="Enter contact address">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ $employee->email }}" placeholder="Enter email address">
                </div>

                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="text" class="form-control datepicker" name="date" value="{{ $employee->date }}" placeholder="Enter date">
                </div>

                <button type="submit" class="btn btn-outline-primary btn-sm mt-3">Update</button>
            </form>

        </div>
    </div>
</div>
   
@endsection

@section('js')

{{-- tinymce editor --}}

    <script>
    $(function() {
      $(".datepicker").datepicker();
   });

  </script>

@endsection
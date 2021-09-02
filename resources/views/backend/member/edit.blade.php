@extends('backend.layouts.app')

@section('title')
    member Edit
@endsection

@section('css')
   
@endsection

@section('backend-content')

<div class="container mt-3">
    <div class="card">
        <div class="card-header">

            <h3 class="card-title">member Edit</h3>

            <div class="container">
                <a href="{{ route('admin.member.index') }}" class="btn btn-outline-info btn-sm float-right">
                   <i class="fas fa-plus-circle fa-w-20"></i><span> Back</span>
                </a>
            </div>
        </div>

        <div class="card-body">
    
            <form action="{{ route('admin.member.update', $member->id) }}" method="post">

                @method('PUT')
                @csrf


                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $member->name }}" placeholder="Enter Name">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ $member->email }}" placeholder="Enter email address">
                </div>

                <div class="form-group">
                    <label for="image">Employee Name</label>
                    <select class="form-control" name="employee_id" id="employee_id">
                        <option value="">Select Employee Name</option>
                        @foreach ($employee as $row)
        
                        <option value="{{ $row->id }}" {{ $row->id == $member->employee_id ? 'selected' : ''  }}>{{ $row->name }}</option>

                        @endforeach

                    </select>
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
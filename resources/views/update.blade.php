@extends('base') 
@section('main')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Update a code</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br /> 
        @endif
        <form method="post" action="{{ route('code.update', $code->id) }}" enctype="multipart/form-data">
            @method('PATCH') 
            @csrf
            <div class="form-group">

                <label for="first_name">First Name:</label>
                <input type="text" class="form-control" name="first_name" value= {{$code->fname }} />
            </div>

            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" class="form-control" name="last_name" value={{$code->lname }} />
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" name="email" value={{$code->email }} />
            </div>

            <div class="form-group">
              <label for="image">image:</label>
              <input type="hidden" name="hidden_image" class="form-control" value={{$code->image}}>

              <input type="file" name="image" class="form-control">
          </div>
          <div class="form-group">
            <label for="city">City:</label>
            <input type="text" class="form-control" name="city" value={{$code->city }} />
        </div>
        <div class="form-group">
            <label for="country">Country:</label>
            <input type="text" class="form-control" name="country" value={{$code->country }} />
        </div>
        <div class="form-group">
            <label for="job_title">Job Title:</label>
            <input type="text" class="form-control" name="job_title" value={{$code->job }} />
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</div>
@endsection
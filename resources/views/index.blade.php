@extends('base')

@section('main')
<div class="row">
<div class="col-sm-12">
    <h1 class="display-3">Contacts</h1>    
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Name</td>
          <td>Email</td>
          <td>Job Title</td>
          <td>City</td>
          <td>Country</td>
          <td colspan = 2>Actions</td>
        </tr>
    </thead>
    <tbody>
        @foreach($code as $contact)
        <tr>
            <td>{{$contact->id}}</td>
            <td>{{$contact->fname}} {{$contact->lname}}</td>
            <td>{{$contact->email}}</td>
            <td>{{$contact->job}}</td>
            <td>{{$contact->city}}</td>
            <td>{{$contact->country}}</td>
            <td>
                <a href="{{ route('code.edit',$contact->id)}}" class="btn btn-primary">Edit</a>
            </td>
            <td>
              

                <a href="#" onclick="del({{$contact->id}})"  ><i class="fa fa-trash eye_icn_size">delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
</div>

<script type="text/javascript">
  function del(id){
//alert(id);

  var c=confirm("Are you sure you want to delete the property ?");
  if(c)
  {

    $.ajax({
      url: "{{ route('code.destroy', $contact->id)}}",
      cache: false,
      type:'DELETE',
      data:{
         "_token": "{{ csrf_token() }}"},
      success: function(html){

      location.reload();


     }
   });
  }
}



</script>
@endsection
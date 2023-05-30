
@extends('app')
@section('content')
<form action="{{ route('departements.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Departement Name:</strong>
                <input type="text" name="name" class="form-control" placeholder="Departement Name">
                @error('name')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Location :</strong>
                <input type="text" name="location" class="form-control" placeholder="Location">
                @error('location')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-group">
        <label for="manager_id">Manager</label>
        <select name="manager_id" class="form-control">
            @foreach ($managers as $manager)
                <option value="{{ $manager->id }}">{{ $manager->name }}</option>
            @endforeach
        </select>
    <div class="col-lg-12 margin-tb">
            <div class="text-end mb-2">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a class="btn btn-warning text-end" href="{{ route('departements.index') }}"> Back</a>
            </div>
          </div>
 </div>
</form>
@endsection
@section('js')
<script type="text/javascript">
    var path = "{{ route('search.workshop') }}";
  
    $( "#search" ).autocomplete({
        source: function( request, response ) {
          $.ajax({
            url: path,
            type: 'GET',
            dataType: "json",
            data: {
               search: request.term
            },
            success: function( data ) {
               response( data );
            }
          });
        },
        select: function (event, ui) {
           $('#search').val(ui.item.label);
           console.log(ui.item); 
           return false;
        }
      });
  
</script>
@endsection
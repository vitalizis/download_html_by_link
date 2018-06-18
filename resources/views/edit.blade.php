@extends('layouts.app')

@section('content') 
<div class="row">
	@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div><br />
@endif
	<div class="col-md-3 col-md-offset-4" style="margin-top: 50px">
<div class="form-group">
<form method="post" action="{{url('/editcolllection')}}">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input type="hidden" value="{{$id}}" name="collection_id" />
    <select class="form-control" id="select_preferences" multiple name="item_id">
    @foreach($itemsPages as $item)
      <option value="page{{$item->id}}">{{$item->link}}</option>
    @endforeach
          @foreach($itemsApp as $item)
      <option value="app{{$item->id}}">{{$item->name_app}}</option>
    @endforeach
  </select>
   <button type="submit" class="btn btn-primary">Отправить</button>
</form>
</div>
</div>
@endsection
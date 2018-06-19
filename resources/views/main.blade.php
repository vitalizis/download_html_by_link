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
		<h3>Сохранить html страницу</h3>
			<form method="post" action="{{action('HtmlDownloaderController@handlerForm')}}">
  <div class="form-group">
  	{{csrf_field()}}
    <label >Введите URL страницы</label>
    <input type="text" class="form-control" name="link">
  </div>
  <button type="submit" class="btn btn-primary">Отправить</button>
</form>
	</div>
	<div class="col-md-3 col-md-offset-4" style="margin-top: 50px">
		<h3>Добавить приложение</h3>
			<form method="post" action="{{ url('/handlerFormApp') }}">
  <div class="form-group">
  	{{csrf_field()}}
    <label for="exampleInputEmail1">Введите названия приложения</label>
    <input type="text" class="form-control" name="name_app">
  </div>
    <div class="form-group">
    <label>Введите цену за хранение</label>
    <input type="number" step="0.01" class="form-control" name="cost">
  </div>
  <button type="submit" class="btn btn-primary">Отправить</button>
</form>
	</div>

    <div class="col-md-3 col-md-offset-4" style="margin-top: 50px">
    <h3>Добавить коллекцию</h3>
      <form method="post" action="{{ url('/handlerFormCollection') }}">
  <div class="form-group">
    {{csrf_field()}}
    <label>Введите имя коллекции</label>
    <input type="text" class="form-control" name="name_collection">
  </div>
  <button type="submit" class="btn btn-primary">Создать коллекцию</button>
</form>
<h2>Список коллекций</h2>
<table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Name</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      @foreach($collections as $item)
      <td scope="row">{{$item->id}}</td>
      <td><a href="{{action('CollectionController@editCollection',$item->id)}}">{{$item->name_collection}}</a></td>
    </tr>
@endforeach
  </tbody>
</table>
  </div>

</div>
@endsection
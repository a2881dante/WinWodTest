@extends('layouts.app')

@section('contents')

    <div class="card">
        <div class="card-header">
            Изменение
        </div>
        <div class="card-body">
            <form method="POST" action="{{url('/items', ['id' => $item->id])}}"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group">
                    <label for="item-name">Наименование товара</label>
                    <input type="text" class="form-control" name="name" id="name"
                           placeholder="Наименование товара" value="{{$item->name}}">
                </div>
                <div class="form-group">
                    <label for="item-name">Размеры:</label>
                    @foreach(\App\Size::all() as $size)
                    <div class="form-group form-check ">
                        <input type="checkbox" class="form-check-input"
                               value="{{$size->id}}" name="sizes[]"
                               @if($item->sizes()->find($size->id)) checked @endif>
                        <label class="form-check-label">{{$size->sign}}</label>
                    </div>
                    @endforeach
                    <input type="file" id="file" name="file"/>
                </div>
                <button type="submit" class="col-12 btn btn-success">Сохранить</button>
            </form>
        </div>
    </div>

@endsection
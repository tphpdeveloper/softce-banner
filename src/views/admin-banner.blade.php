@extends('mage2-ecommerce::admin.layouts.app')

@section('content')

    <div class="box">
        <div class="box-header">
            <h2>
                <i class="fa fa-list-ul"></i>
                <span class="main-title-wrap">Список банеров</span>
            </h2>
            <form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <fieldset>
                    <legend>Добавить новый баннер</legend>
                    <input type="file" name="new_banner[]" multiple accept="image/png,image/gif,image/jpeg" >
                    @if($errors->has('new_banner'))
                        <div class="alert alert-danger">{{ $errors->first('new_banner') }}</div>
                    @endif
                    <br >
                    <input class="btn btn-info" type="submit" value="Отправить">
                </fieldset>
            </form>

        </div>
        <div class="box-body">
            <table class="table  table-hover options_table js-data_grid_table">
                <thead>
                    <tr>
                        <th>№</th>
                        <th>Изображение</th>
                        <th>URL</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @if($models)
                    @foreach($models as $co => $model)
                        <tr>
                            <td>{{ $co + 1 }}</td>
                            <td>
                                <img  style="width: 250px; height: auto;" src="{{ asset($path_banner.'/'.$model->path) }}" alt="" >
                                <input form="admin-banner-update-{{ $model->id }}" type="file" name="banner" >
                            </td>
                            <td>

                                <input class="form-control" type="url" form="admin-banner-update-{{ $model->id }}" name="uri" value="{{ $model->uri or '' }}">
                            </td>
                            <td>
                                {{--update slide info--}}
                                <form id="admin-banner-update-{{ $model->id }}" class="inline-form" method="POST"
                                    action="{{ route('admin.banner.update', [$model->id]) }}"
                                    enctype='multipart/form-data'
                                    >
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}

                                    <input type='submit' class='btn btn-info' value='Изменить'>
                                </form>

                                {{--delete slide--}}
                                <form id="admin-banner-destroy-{{ $model->id }}" class="inline-form" method="POST"
                                    action="{{ route('admin.banner.destroy', $model->id) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <a href="#" data-destroy="jQuery('#admin-banner-destroy-{{ $model->id }}').submit()"  class="btn btn-danger js-delete" >
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
@stop
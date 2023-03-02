@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Добавить товар</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Добавить товар</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <input type="text" value="{{ old('title') }}" name="title" class="form-control"
                            placeholder="Наименование">
                    </div>
                    <div class="form-group">
                        <input type="text" value="{{ old('description') }}" name="description" class="form-control"
                            placeholder="Описание">
                    </div>
                    <div class="form-group">
                        <textarea name="content" cols="30" rows="10" class="form-control" placeholder="Содержание">{{ old('content') }}</textarea>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                        <div class="custom-file">
                                <input name="preview_image" type="file" class="custom-file-input">
                                <label class="custom-file-label">Выберите файл превью</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="custom-file">
                                    <input name="product_images[]" type="file" class="custom-file-input" multiple>
                                    <label class="custom-file-label">Выберите файлы товаров</label>
                                </div>
                            </div>
                    </div>

                    <div class="form-group">
                        <input type="text" value="{{ old('price') }}" name="price" class="form-control"
                            placeholder="Цена">
                    </div>
                    <div class="form-group">
                        <input type="text" value="{{ old('count') }}" name="count" class="form-control"
                            placeholder="Количество">
                    </div>
                    <div class="form-group">
                        <select name="tags[]" class="tags" multiple="multiple" data-placeholder="Выберите тег"
                            style="width: 100%;">
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}"
                                    {{ is_array(old('tags')) && in_array($tag->id, old('tags')) ? 'selected' : '' }}>
                                    {{ $tag->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="colors[]" class="colors" multiple="multiple" data-placeholder="Выберите цвет"
                            style="width: 100%;">
                            @foreach ($colors as $color)
                                <option value="{{ $color->id }}"
                                    {{ is_array(old('colors')) && in_array($color->id, old('colors')) ? 'selected' : '' }}>
                                    {{ $color->title }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <select name="category_id" class="form-control select2" style="width: 100%;">
                            <option selected="selected" disabled>Выберите категорию</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $category->id == old('category_id') ? 'selected' : '' }}>
                                    {{ $category->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="group_id" class="form-control select2" style="width: 100%;">
                            <option selected="selected" disabled>Выберите группу</option>
                            @foreach ($groups as $group)
                                <option value="{{ $group->id }}"
                                    {{ $group->id == old('group_id') ? 'selected' : '' }}>
                                    {{ $group->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Добавить">
                    </div>
                </form>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection

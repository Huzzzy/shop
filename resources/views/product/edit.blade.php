@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактировать товар</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Редактировать товар</li>
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
                <form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('patch')

                    <div class="form-group w-75">
                        <input type="text" value="{{ old('title', $product->title) }}" name="title"
                            class="form-control" placeholder="Наименование">
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group w-75">
                        <input type="text" value="{{ old('description', $product->description) }}" name="description"
                            class="form-control" placeholder="Описание">
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group w-75">
                        <textarea name="content" cols="30" rows="10" class="form-control" placeholder="Содержание">{{ old('content', $product->content) }}</textarea>
                        @error('content')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group w-100">
                        <h3>Текущее фото превью</h3>
                        <img src="{{ $product->imageUrl }}" alt="#" style="width: 300px; height: 300px;">
                        <div class="input-group w-75">
                            <div class="custom-file">
                                <input name="preview_image" type="file" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Выберите фото превью</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Загрузка</span>
                            </div>
                        </div>
                        @error('preview_image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group w-100">
                        <h3>Текущие фото товаров</h3>
                        @foreach ($productImages as $productImage)
                            <img src="{{ $productImage->imageUrl }}" alt="#" style="width: 300px; height: 300px;">
                        @endforeach
                        <div class="input-group w-75">
                            <div class="custom-file">
                                <input name="product_images[]" type="file" class="custom-file-input" multiple>
                                <label class="custom-file-label">Выберите фото товаров</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Загрузка</span>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="form-group w-50">
                <input type="text" value="{{ old('price', $product->price) }}" name="price" class="form-control"
                    placeholder="Цена">
                @error('price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group w-50">
                <input type="text" value="{{ old('count', $product->count) }}" name="count" class="form-control"
                    placeholder="Количество">
                @error('count')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group w-50">
                <select name="tags[]" class="tags" multiple="multiple" data-placeholder="Выберите тег"
                    style="width: 100%;">
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}"
                            {{ is_array($product->tags->pluck('id')->toArray()) &&
                            in_array($tag->id, $product->tags->pluck('id')->toArray())
                                ? 'selected'
                                : '' }}>
                            {{ $tag->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group w-50">
                <select name="colors[]" class="colors" multiple="multiple" data-placeholder="Выберите цвет"
                    style="width: 100%;">
                    @foreach ($colors as $color)
                        <option value="{{ $color->id }}"
                            {{ is_array($product->colors->pluck('id')->toArray()) &&
                            in_array($color->id, $product->colors->pluck('id')->toArray())
                                ? 'selected'
                                : '' }}>
                            {{ $color->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group w-50">
                <select name="category_id" class="form-control select2" style="width: 100%;">
                    <option selected="selected" disabled>Выберите категорию</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $category->id == old('category_id', $category->id) ? 'selected' : '' }}>
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group w-50">
                <select name="group_id" class="form-control select2" style="width: 100%;">
                    <option selected="selected" disabled>Выберите группу</option>
                    @foreach ($groups as $group)
                        <option value="{{ $group->id }}"
                            {{ $group->id == old('group_id', $group->id) ? 'selected' : '' }}>
                            {{ $group->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Редактировать">
            </div>
            </form>
        </div>
        <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection

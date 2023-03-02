@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Товар</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Товар</li>
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

                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex p-3">
                            <div class="mr-2">
                                <a href="{{ route('product.edit', $product->id) }}"
                                    class="btn btn-primary">Редактировать</a>
                            </div>
                            <div class="mr-2">
                                <form action="{{ route('product.delete', $product->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" value="Удалить" class="btn btn-danger">
                                </form>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $product->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Наименование</th>
                                        <td>{{ $product->title }}</td>
                                    </tr>
                                    <tr>
                                        <th>Описание</th>
                                        <td>{{ $product->description }}</td>
                                    </tr>
                                    <tr>
                                        <th>Содержание</th>
                                        <td>{{ $product->content }}</td>
                                    </tr>
                                    <tr>
                                        <th>Превью</th>
                                        <td><img src="{{ $product->imageUrl }}" alt="#"
                                                style="width: 300px; height: 300px;"></td>
                                    </tr>
                                    <tr>
                                        <th>Фото товара</th>
                                        <td>
                                            @foreach ($productImages as $productImage)
                                                <img src="{{ $productImage->imageUrl }}" alt="#"
                                                    style="width: 300px; height: 300px;">
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Категория</th>
                                        <td>{{ $product->category->title }}</td>
                                    </tr>
                                    <tr>
                                        <th>Группа</th>
                                        <td>{{ $product->group->title }}</td>
                                    </tr>
                                    <tr>
                                        <th>Теги</th>
                                        <td>
                                            @foreach ($product->tags as $tag)
                                                {{ $tag->title }}
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Цвета</th>
                                        <td>
                                            @foreach ($product->colors as $color)
                                                <div style="width: 50px; background: {{ '#' . $color->title }}">
                                                    {{ $color->title }}
                                                </div>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Цена</th>
                                        <td>{{ $product->price }}$</td>
                                    </tr>
                                    <tr>
                                        <th>Количество</th>
                                        <td>{{ $product->count }}</td>
                                    </tr>
                                    <tr>
                                        <th>Опубликовано</th>
                                        <td>{{ $product->isPublishedTitle }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>


            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection

@extends('layout.base')

@section('title', 'アップロード')

@section('css')

@endsection

@section('content')
    <div class="frame">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
        <form method="POST" action="/image/upload" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="formFile" class="form-label">画像ファイル</label>
                <input class="form-control" type="file" name="image" id="formFile" accept="image/*" required>
                <div id="imageHelp" class="form-text">jpeg,png,jpg,gifに対応,1メガバイトまで</div>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">アップロード</button>
            </div>
        </form>

        <div class="result">
            <h1>アップロードされた画像一覧</h1>
            <ul>
                @foreach ($data as $item)
                <li><a href="/image/{{ $item->file }}">{{ $item->file }}</a></li>
                @endforeach
            </ul>
            {{ $data->links() }}
        </div>
    </div>
@endsection

@section('javascript')

@endsection

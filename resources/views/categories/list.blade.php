@extends("layouts.sidebar")

@section('title-page')
    <title> Categories </title>
@endsection

@section('style')

@endsection

@section('script')

@endsection

@section('content')
    @foreach($test as $i)
        <h3>{{$i}}</h3>
    @endforeach
@endsection

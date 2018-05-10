@extends( 'layouts.app' )

@section( 'content' )
    <a href="{{ url( '/' ) }}" class="button">Go Back</a>
    <h1>{{ $album->name }}</h1>
    <img style="width: 100px; height: 100px;" src="{{url( "/storage/album_covers/$album->cover_image" )}}" alt="">
    <br>
    <hr>
    <a href="{{ url( "/photos/create/$album->id" ) }}" class="button">Upload photo to album</a>
    @endsection
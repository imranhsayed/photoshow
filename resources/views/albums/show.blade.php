@extends( 'layouts.app' )

@section( 'content' )
    <a href="{{ url( '/' ) }}" class="button">Go Back</a>
    <h1>{{ $album->name }}</h1>
    <img style="width: 100px; height: 100px;" src="{{url( "/storage/album_covers/$album->cover_image" )}}" alt="">
    <br>
    <hr>
    <a href="{{ url( "/photos/create/$album->id" ) }}" class="button">Upload photo to album</a>

    <hr>
    {{--$album->photos will contain all the photos data that belongs to the album with the given id--}}
    @if( $album->photos )
        <div>
        @foreach( $album->photos as $photo )
            @php
                $photo_id = $photo->id;
                $url = url( "storage/photos/$album->id/$photo->photo" );
            @endphp
            <div>
                <a href="{{url( "photos/$photo_id" )}}"><img style="width: 100px; height: 100px;" src="{{url( "$url" )}}" alt=""></a>
                <p>{{$photo->title}}</p>
            </div>
            @endforeach
        </div>
    @endif
    @endsection
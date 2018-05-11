@extends( 'layouts.app' )

@section( 'content' )
    @if( $photo )
    <a href="{{ url( '/' ) }}" class="button">Go Back</a>
    <h1>{{ $photo->title }}</h1>
    <img style="width: 100px; height: 100px;" src="{{url( "/storage/photos/$photo->album_id/$photo->photo" )}}" alt="">
    <br>
    <hr>
    {!!Form::open(['action' => [ 'PhotosController@destroy', $photo->id ], 'method' => 'POST'])!!}
    {{Form::hidden( '_method', 'DELETE' )}}
    {{Form::submit('delete')}}
    {!! Form::close() !!}
    @endif
@endsection
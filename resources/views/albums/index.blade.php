@extends( 'layouts.app' )

@section( 'content' )
    <h3>Home</h3>
    @if( count( $albums ) )
        @php
        $colcount = count( $albums );
        $i = 1;
        @endphp
        <div id="albums">
            <div class="row">
                @foreach( $albums as $album )
                        <div class="medium-4 columns float-left">
                            <a href="{{url( "/albums/$album->id" )}}">
                                <img src="{{url( "storage/album_covers/$album->cover_image" )}}" style="width: 200px; height: 200px;" class="thumbnail" alt="">
                            </a>
                            <br>
                            <h6 class="text-center">{{$album->name}}</h6>
                        </div>
                    @endforeach
            </div>
        </div>
        @else
        <p>No album to display</p>
    @endif

    @endsection
@if( count( $errors->all() ) )
    @foreach( $errors->all() as $error )
        <div class="callout alert">
            {{ $error }}
        </div>
    @endforeach
@endif

@if( count( $success_message = session( 'success' ) ) )
    <div class="callout success">
        {{$success_message}}
    </div>
@endif

@if( count( $error_message = session( 'error' ) ) )
    <div class="callout alert">
        {{$error_message}}
    </div>
@endif
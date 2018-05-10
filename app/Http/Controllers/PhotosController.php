<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;

class PhotosController extends Controller
{
    function create( $album_id ) {
    	return view( 'photos.create', compact( 'album_id' ) );
    }

    function store( Request $request ) {
    	$this->validate( request(), [
		    'title' => 'required',
		    'photo' => 'image|max:1999'
	    ] );

	    // Original filename with extension.
	    $file_name_with_ext = $request->file( 'photo' )->getClientOriginalName();
	    // Original filename without extension.
	    $filename = pathinfo( $file_name_with_ext, PATHINFO_FILENAME );
	    // File extension.
	    $extension = $request->file( 'photo' )->getClientOriginalExtension();
	    // File name with current time appended for the uniqueness of the file.
	    $file_name_to_store = $filename . '_' . time() . '.' .$extension;
	    // File size
	    $photo_size = $request->file( 'photo' )->getClientSize();

	    $album_id = $request->input( 'album_id' );

	    /**
	     * Uploads Photo .
	     * The file gets stored in storage/app/public/album_covers.
	     * It will look for album_covers directory.If its not there it will create it and store it inside of it.
	     */
	    $path = $request->file( 'photo' )->storeAs( "public/photos/$album_id", $file_name_to_store );

	    // Save photo data
	    $photo = new Photo;
	    $photo->title = ( $request->input( 'title' ) ) ? $request->input( 'title' ) : '';
	    $photo->album_id = ( $request->input( 'album_id' ) ) ? $request->input( 'album_id' ) : '';
	    $photo->description = ( $request->input( 'description' ) ) ? $request->input( 'description' ) : '';
	    $photo->size = ( $photo_size ) ? $photo_size : '';
	    $photo->photo = ( $file_name_to_store ) ? $file_name_to_store : '';
	    $photo->save();

	    // Redirect
	    return redirect( url( "/albums/$album_id" ) )->with( 'success', 'Photo Stored Successfully in the Album' );
    }
}

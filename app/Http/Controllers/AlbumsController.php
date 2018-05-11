<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Album;

class AlbumsController extends Controller
{
    function index() {
//    	$albums = Album::orderBy( 'created_at', 'desc' )->get(); or
	    $albums = Album::with( 'Photos')->get();
    	return view( 'albums.index', compact( 'albums' ) );
    }

    function create() {
    	return view( 'albums.create' );
    }

    function store( Request $request ) {
		$this->validate( request(), [
			'name' => 'required',
			'cover_image' => 'image|max:1999'
		] );

		// Original filename with extension.
		$file_name_with_ext = $request->file( 'cover_image' )->getClientOriginalName();
	    // Original filename without extension.
		$filename = pathinfo( $file_name_with_ext, PATHINFO_FILENAME );
		// File extension.
	    $extension = $request->file( 'cover_image' )->getClientOriginalExtension();
	    // File name with current time appended for the uniqueness of the file.
	    $file_name_to_store = $filename . '_' . time() . '.' .$extension;

	    /**
	     * Uploads File .
	     * The file gets stored in storage/app/public/album_covers.
	     * It will look for album_covers directory.If its not there it will create it and store it inside of it.
	     */
	    $path = $request->file( 'cover_image' )->storeAs( 'public/album_covers', $file_name_to_store );

	    // Save data
	    $album = new Album;
	    $album->name = ( $request->input( 'name' ) ) ? $request->input( 'name' ) : '';
	    $album->description = ( $request->input( 'description' ) ) ? $request->input( 'description' ) : '';
	    $album->cover_image = ( $file_name_to_store ) ? $file_name_to_store : '';
	    $album->save();

	    // Redirect
	    return redirect( url( '/' ) )->with( 'success', 'Album Stored Successfully' );

    }

    public function show( $id ) {
//		$album = Album::find( $id );
	    /**
	     * $album will contain data for the current album and obj called photos containing data for all photos that belongs to this album id.
	     */
	    $album = Album::with( 'Photos' )->find( $id );
	    return view( 'albums.show', compact( 'album' ) );

    }
}

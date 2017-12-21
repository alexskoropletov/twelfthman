@extends('layout')

@section('content')
    <div class="row filter-row">
        <div class="btn-group btn-group-sm" role="group" aria-label="Filter">
            <button type="button" class="filter btn" data-status="1">Active</button>
            <button type="button" class="filter btn btn-primary" data-status="0">Deleted</button>
        </div>
    </div>
    <div class="row photos-row">
        @foreach ($photos as $photo)
            <div class="col-md-3 image status{{ $photo->status }}" data-id="{{ $photo->id }}" data-image="{{ $photo->image }}">
                <div class="photo-and-caption">
                    <div class="photo">
                        <img src="storage/thumbnail/{{ $photo->thumbnail }}" alt="{{ $photo->name }}">
                    </div>
                    <div class="caption">
                        <p>{{ $photo->name }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- TODO: make this menu sticky to visible part of the display -->
    <!-- TODO: Update styles for smaller resolutions -->
    <footer class="footer">
        <div class="container controls">
            <button type="button" class="btn btn-primary delete" aria-label="Delete">
                <span class="glyphicon glyphicon-trash delete" aria-hidden="true"></span>
            </button>
            <a href="#" target="_blank" class="btn btn-primary download" aria-label="Download">
                <span class="glyphicon glyphicon-download-alt download" aria-hidden="true"></span>
            </a>
        </div>
    </footer>
@endsection
@extends('layout')

@section('content')
    <div class="row filter-row">
        <div class="btn-group btn-group-sm" role="group" aria-label="Filter">
            <button type="button" class="filter active btn" data-action="active">Active</button>
            <button type="button" class="filter deleted btn btn-primary" data-action="deleted">Deleted</button>
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
    <footer class="footer">
        <div class="container">
            <button type="button" class="btn btn-primary" aria-label="Delete">
                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
            </button>
            <button type="button" class="btn btn-primary" aria-label="Download">
                <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>
            </button>
        </div>
    </footer>
@endsection
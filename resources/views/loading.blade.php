@extends('layout')

@section('content')
    <div class="row filter-row">
        <div class="btn-group btn-group-sm add-group" role="group" aria-label="Filter">
            <button type="button" class="filter btn btn-primary add" data-status="1" data-action="add">Add</button>
        </div>
        <div class="btn-group btn-group-sm filter-group" role="group" aria-label="Filter">
            <button type="button" class="filter btn" data-status="1" data-action="show">All</button>
            <button type="button" class="filter btn btn-primary" data-status="0" data-action="show">Deleted</button>
        </div>
    </div>
    <div class="row photos-row">
        <h2>Loading ...</h2>
    </div>
    <footer class="footer">
        <div class="container controls">
        </div>
    </footer>
@endsection
@foreach ($photos as $photo)
    <div class="col-sx-6 col-sm-4 col-md-3 image status{{ $photo->status }}" data-id="{{ $photo->id }}" data-image="{{ $photo->image }}">
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
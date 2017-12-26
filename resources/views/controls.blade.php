<form id='controls-form' method="{{ $method  }}" action="/{{ $action  }}/{{ $photo->id }}">
    {{ csrf_field() }}
    @if ($action === 'destroy')
        <button type="submit" class="btn btn-primary destroy" aria-label="Delete">
            <span class="glyphicon glyphicon-trash destroy" aria-hidden="true"></span>
        </button>
        <a href="/download/{{ $photo->id }}" target="_blank" class="btn btn-primary download" aria-label="Download">
            <span class="glyphicon glyphicon-download-alt download" aria-hidden="true"></span>
        </a>
    @else
        <button type="submit" class="btn btn-primary restore" aria-label="Restore">
            <span class="glyphicon glyphicon-refresh restore" aria-hidden="true"></span>
        </button>
    @endif
</form>
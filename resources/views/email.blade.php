<p>
    <strong>Message:</strong> {{ $e->getMessage() }}<br>
    <strong>File:</strong> {{ $e->getFile() }}:{{ $e->getLine() }}<br>
    <strong>Request:</strong> {{ app('request')->getRequestUri() }}<br>
    <strong>Timestamp:</strong> {{ Carbon\Carbon::now()->toDateTimeString() }}<br>
    <strong>User:</strong> {{ auth()->check() ? auth()->user()->id : 'Not logged in' }}
</p>
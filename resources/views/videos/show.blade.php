<ul>
    <li>{{ $video->title }}</li>
    <li>Description: {{ $video->description }}</li>
    <li>{{ $video->published_at->format('F d') }}</li>
</ul>

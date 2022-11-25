<ul>
    <p>{{ $video->title }}</p>
    <li>Description: {{ $video->description }}</li>
    <li>{{ $video->published_at->format('F d') }}</li>
</ul>

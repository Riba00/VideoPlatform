<x-casteaching-layout>
    <p>{{ $video->title }}</p>
    <ul>
        <li>Description: {{ $video->description }}</li>
        <li>{{ $video->published_at->format('F d') }}</li>
    </ul>
</x-casteaching-layout>

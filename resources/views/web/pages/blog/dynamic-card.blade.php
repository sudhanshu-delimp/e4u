@foreach ($blogs as $blog)
    <div class="card-content">
    <div class="card-img">
        <img src="{{ $blog['blog_image'] }}" alt="Blog Image">
        <small>{{$blog['created_At'] ?? $blog['created_at']->format('d M Y')}}</small>
    </div>
    <div class="card-desc p-3 mb-3">
        <h3>{{$blog['title'] ?? ''}}</h3>
       <div class="excerpt">{!! strip_tags(Str::limit($blog['description'] ?? '', 150, '')) !!}</div>
        <a href="{{ route('blogs.detail', ['slug' => $blog['slug']]) }}">
            Read More
            <svg fill="#ff3c5f" width="10px" height="10px" viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <g fill-rule="evenodd">
                        <path d="M0 92.168 92.299 0l959.931 959.935L92.299 1920 0 1827.57l867.636-867.635L0 92.168Z">
                        </path>
                        <path
                            d="M868 92.168 960.299 0l959.931 959.935L960.299 1920 868 1827.57l867.64-867.635L868 92.168Z">
                        </path>
                    </g>
                </g>
            </svg>
        </a>
    </div>
</div>
@endforeach


@foreach ($archives as $arcBlog)
<ul>
    <li><a href="{{ route('blogs.detail', ['slug' => $arcBlog['slug']]) }}">{{$arcBlog['title']}}</a></li>
</ul>
@endforeach
<li><a href="{{ Request::root() }}/admin/category/{{ $category['id'] }}/books">{{ $category['name'] }}</a></li>
    @if (count($category['children']) > 0)
        <ul>
        @foreach($category['children'] as $category)
            @include('partials.category', $category)
        @endforeach
        </ul>
    @endif
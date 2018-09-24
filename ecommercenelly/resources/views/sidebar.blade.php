<h3>Categories</h3>

<ul class="list-group">
    @foreach($archives as $archive)
    <li class="list-group-item">
        <a href="/productsbuyer?category_name={{ $archive['id'] }}">
        @if(($archive->products->count())!="0")
                    {{ $archive['category_name'] }}
                    ({{ $archive->products->count() }})
        @endif
            </a>
    </li>
    @endforeach
</ul>
@foreach($models AS $image)
    <img onclick="changeImage(this); return false;"  data-image-id="{{ $image->id }}" class="image-choose" width="100px" src="{{ $image->url }}"/>

@endforeach
<div class="image-row">
    {!! \PaginationHelper::render($offset, $limit, $count, $baseUrl, $params, 10, 'shared.paging_image') !!}
</div>
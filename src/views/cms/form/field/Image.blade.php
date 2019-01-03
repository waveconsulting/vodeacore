<div class="image-section {!! ($imageCount == -1) ? 'image-multiple-wrapper' : '' !!}">

    @if(!empty($model->getValue($key, $listItem, $language)))
        @foreach($model->getValue($key, $listItem, $language) as $imageKey=>$image)
            @include('admin.cms.form.field.ImagePart')
        @endforeach
    @endif

    @if($imageCount == -1)
        @php
            $imageKey = count($model->getValue($key, $listItem, $language));
            $image = null;
        @endphp
        @if(empty($model->isDisabled($key)))
            @include('admin.cms.form.field.ImagePart')
        @endif
    @elseif( $imageCount >= count($model->getValue($key, $listItem, $language)) )
        @foreach( range(count($model->getValue($key, $listItem, $language)), $imageCount)  as $imageKey)
            @include('admin.cms.form.field.ImagePart')
        @endforeach
    @endif

</div>
@php
    $isList = true;
    if (empty($listType)) {
        $listType = $model::FORM_TYPE;
        $isList = false;
    }
@endphp


<div class="card">
    <div class="card-body">
        <h4 class="card-title">{!! @$title !!}</h4>

        @if($model::USE_META_SET)
            @include('cms::form.meta')
        @endif

        @foreach( $listType as $key=>$value)
            @php
                $formType = $model->formType($key);
                if ($isList) $formType = $listType[$key];

                $allowedExtension = '';

                if( strpos( $formType , 'Image' ) !== false ){
                    $imageCount = (substr($formType, 6) - 1);
                    $formType = 'Image';
                    $allowedExtension = 'image/*';
                }

                if( strpos( $formType , 'Rating' ) !== false ){
                    $ratingCount = (substr($formType, 7));
                    $formType = 'Rating';
                }

                if (!isset($listItem)) $listItem = '';
                if (!isset($listName)) $listName = '';
                if (!isset($listIndex)) $listIndex = '';
            @endphp

            @include('cms::form.group')
        @endforeach

        @include('cms::form.button')

    </div>
</div>
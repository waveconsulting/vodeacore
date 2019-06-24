@php
    $isList = true;
    if (empty($listType)) {
        $listType = $model::FORM_TYPE;
        $isList = false;
    }
    $languageAdd = (\Illuminate\Support\Facades\Config::get('cms.LANGUAGE_ADD')) ? \Illuminate\Support\Facades\Config::get('cms.LANGUAGE_ADD') : [];
    $formTypeLanguage = $model::FORM_TYPE_LANGUAGE;
@endphp


@foreach( $listType as $key=>$value)
    @php
        $language = '';
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

    @if ($formType && $formType != 'ListSortable' && $model->isRemoved($key))
        @include('cms::form.group')
    @endif

    @if(in_array($key, $formTypeLanguage))
        @if(count($languageAdd))
            @foreach($languageAdd as $language)
                @include('cms::form.group')
            @endforeach
        @endif
    @endif

@endforeach

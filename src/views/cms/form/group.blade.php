<div class="form-group">
    <label @if($model->isRequired($key) == 'required') class="label-required" @endif>
        {{ $model->label($key, $language) }}
        @if(!empty($model->labelHelp($key)))<span class="label-help">({{ $model->labelHelp($key) }})</span>@endif
    </label>
    @include('cms::form.field.'.$formType)
</div>

@if($buttonSection)
    <div class="btn-form-wrapper">
        @if(@$model::ALLOW_UPDATE)
            <button type="submit" class="btn btn-success mr-2 ladda-button" data-color="red" data-style="zoom-in"><span class="ladda-label">Submit</span></button>
        @endif
        <a href="{!! $cancelUrl !!}" class="btn btn-light">Cancel</a>
    </div>
@endif

<table class="datatable table table-hover table-striped primary" {!! @$url ? 'data-use-ajax="true"' : '' !!} {!! @$url ? 'data-ajax-url="'.$url.'"' : '' !!} {!! @$id ? 'id="'.$id.'"' : '' !!} {!! isset($generateUrl) ? 'data-generate-url="'.json_encode($generateUrl).'"' : 'data-generate-url="true"'!!}>
    @if(!empty($thead))
        <thead>{{ $thead }}</thead>
    @endif
    @if(!empty($tbody))
        <tbody>{{ $tbody }}</tbody>
    @endif
    @if(!empty($tfoot))
        <tfoot>{{ $tfoot }}</tfoot>
    @endif
</table>

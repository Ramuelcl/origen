@props(['sortDir', 'sortCampo', 'campo'])

@if( $sortCampo == $campo)
@if( $sortDir == "asc")
<i class="fa-solid fa-sort-up"></i>
@else
<i class="fa-solid fa-sort-down"></i>
@endif
@else
<i class="fa-solid fa-sort"></i>
@endif

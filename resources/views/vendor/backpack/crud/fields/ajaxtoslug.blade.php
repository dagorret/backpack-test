<!-- ajaxtoslug -->
<div @include('crud::inc.field_wrapper_attributes') >
<label>{!! $field['label'] !!}</label>
@include('crud::inc.field_translatable_icon')

@if(isset($field['prefix']) || isset($field['suffix'])) <div class="input-group"> @endif
    @if(isset($field['prefix'])) <div class="input-group-addon">{!! $field['prefix'] !!}</div> @endif
    <input
            type="text"
            name="{{ $field['name'] }}"
            value="{{ old(square_brackets_to_dots($field['name'])) ?? $field['value'] ?? $field['default'] ?? '' }}"
            onchange="updateInput(this.value)"
            @include('crud::inc.field_attributes')
    >
    @if(isset($field['suffix'])) <div class="input-group-addon">{!! $field['suffix'] !!}</div> @endif
    @if(isset($field['prefix']) || isset($field['suffix'])) </div> @endif

{{-- HINT --}}
@if (isset($field['hint']))
    <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
    </div>


    @if ($crud->checkIfFieldIsFirstOfItsType($field))
        {{-- FIELD EXTRA CSS  --}}
        {{-- push things in the after_styles section --}}

        @push('crud_fields_styles')
            <!-- no styles -->
        @endpush

        {{-- FIELD EXTRA JS --}}
        {{-- push things in the after_scripts section --}}

        @push('crud_fields_scripts')
            <script type="text/javascript">
                var slug = function(str) {
                    str = str.replace(/^\s+|\s+$/g, ''); // trim
                    str = str.toLowerCase();

                    // remove accents, swap ñ for n, etc
                    var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;";
                    var to   = "aaaaaeeeeeiiiiooooouuuunc------";
                    for (var i=0, l=from.length ; i<l ; i++) {
                        str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
                    }

                    str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                        .replace(/\s+/g, '-') // collapse whitespace and replace by -
                        .replace(/-+/g, '-'); // collapse dashes

                    return str;
                };

                function updateInput(ish){
                    //document.getElementById("ib").value = ish;
                    $('input[name="{{ $field['to_slug'] }}"]').val(slug(ish));
                }
            </script>
        @endpush
    @endif


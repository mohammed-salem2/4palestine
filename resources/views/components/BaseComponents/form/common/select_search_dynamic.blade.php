@props([
    'name',
    'model' => $model,
    'options' => $model,
    'option_id_column' => 'id',
    'option_value_column' => 'name',
    'option_label_column' => 'name',
    'label' => class_basename($model) . ' ' . preg_quote($name, '_') ? str_replace("_", " ", $name) : $name ,
    'cols' => '6',
])


<div class="mb-3 col-12 col-sm-{{ $cols }} d-flex flex-column" data-select2-id="21">
    <label class="form-label">{{ ucwords($label) }}</label>
    <select name="{{ $name }}" @class(['single-select select2-hidden-accessible', 'is-invalid' => $errors->has($name)]) {{ $attributes }} data-select2-id="1" tabindex="-1" aria-hidden="true">
        {{-- <option value="United States" data-select2-id="3">United States</option> --}}
        @foreach ($options as $option)
            <option value="{{ $option[$option_value_column] }}" data-select2-id="{{ $option[$option_id_column] }}" @selected(old($name, $model[$name]) == $option[$option_value_column])>{{ $option[$option_label_column] }}</option>
        @endforeach
    </select>
    {{-- <span class="select2 select2-container select2-container--bootstrap4 select2-container--below select2-container--focus" dir="ltr" data-select2-id="2"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-fq8i-container"><span class="select2-selection__rendered" id="select2-fq8i-container" role="textbox" aria-readonly="true" title="United States">United States</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span> --}}
    @error($name)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

@push('style')
    <link href="{{ asset('admin/assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endpush

@push('script')
    <script src="{{ asset('admin/assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/form-select2.js') }}"></script>
@endpush


{{--Docs
    Author: khaled - 14/10/2022
_____________________________________________________________________________________
    * name => input name, should be same as DB attr
    * model => the Model (table) of this item, we use it to show data when editing
    * label =>[OPTIONAL] input label
    * options => array of values that need to be set as options in the select
    * option_id_column => column of DB that need to be the id in data-select2-id="" attr of this option
    * option_value_column => column of DB that need to be the value of this option [default = id]
    * option_label_column => the label to show of this option [ default = name ]

    Full EXAMPLE:-
        <x-BaseComponents.form.common.select_search_dynamic name="parent_id" :model="$model" label="Parent ID"
        :options="$additionalData['parents']" option_id_column="id" option_value_column="name" option_label_column="name" />

    Less EXAMPLE:-
        <x-BaseComponents.form.common.select_search_dynamic
        name="parent_id"
        :model="$model"
        :options="$additionalData['parents']"/>

_____________________________________________________________________________________
--}}


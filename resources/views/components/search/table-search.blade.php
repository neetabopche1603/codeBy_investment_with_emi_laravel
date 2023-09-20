@push('style')
    <style>
        .input-group {
            width: 30% !important;
            float: right !important;
        }

        @media screen and (max-width: 768px) {
            .input-group {
                width: 40% !important;
                float: right !important;
            }
        }

        @media screen and (max-width: 480px) {
            .input-group {
                width: 100% !important;
                float: right !important;
            }
        }
    </style>
@endpush
<div class="mx-3 mt-4">
    <form action="{{ $action }}" method="{{ $method }}">
        <div class="input-group">
            <input type="text" class="form-control {{ $class }}" id="{{ $id }}"
                name="{{ $name }}" value="{{ $value }}" placeholder="{{ $placeholder }}">
            <button type="{{ $btn_type }}" class="btn btn-primary {{ $btnClass }}">Search</button>
        </div>
    </form>
</div>

{{-- <div class="mx-3 mt-4">
    <form action="{{ $action }}" method="{{ $method }}">
        <div class="row">
            <div class="col-md-3 col-sm-4 col-9">
                <input type="text" class="form-control {{ $class }}" id="{{ $id }}"
                    name="{{ $name }}" value="{{ $value }}" placeholder="{{ $placeholder }}">
            </div>
            <div class="col-md-2 col-sm-2 col-2">
                <button type="{{ $btn_type }}" class="btn btn-primary {{ $btnClass }}">Search</button>
            </div>
        </div>
    </form>
</div> --}}



<div class="modal fade bs-example-modal-lg show" tabindex="-1" aria-labelledby="myModal" style="display: block; padding-right: 15px;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered {{$modal_size}}">
        <div class="modal-content">
            @include('common.crud_modal_header')

            @include($view_form)

            @include('common.crud_modal_footer')

        </div>
    </div>
</div>

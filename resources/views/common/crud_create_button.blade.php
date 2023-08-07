@if($allow_create)
    <button wire:click="create()" class="btn btn-info">
        {{__($create_button_label)}}
    </button>
@endif
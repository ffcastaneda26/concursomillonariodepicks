
<div class="d-flex justify-content-end">
    @if($allow_edit)
        <span class="mx-2">
            <button wire:click="closeModal()"
                class="btn btn-danger">
                {{__("Cancel")}}
            </button>
        </span>
        <span class="mx-2">
            <button wire:click.prevent="store()"
                class="btn btn-success">
                {{__("Save")}}
            </button>
        </span>
    @else
        <span class="mx-2">
            <button wire:click="closeModal()"
                class="btn btn-success">
                Regresar
            </button>
        </span>
    @endif

</div>

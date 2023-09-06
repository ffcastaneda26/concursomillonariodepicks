<td>
    <input type="radio"
            wire:model='picks.{{ $loop->index }}'
            name="winner-{{ $loop->index }}"
            value="2"
            {{ !$allow_pick  ? 'disabled' : ''}}
                       {{ isset($pick_user) && $pick_user->winner == 2 ? 'checked' : ''}}
    />
</td>

{{-- Icono si acertó/falló o aún no se sabe --}}
@include('livewire.picks.pick_icono_acerto')

{{-- Pronostica que gana Local --}}
<td>
    <input type="radio"
                wire:model='picks.{{ $loop->index }}'
                name="winner-{{$loop->index}}"
                value="1"
                {{ !$allow_pick  ? 'disabled' : ''}}
                {{ isset($pick_user) && $pick_user->winner == 1 ? 'checked' : ''}}
        />

</td>

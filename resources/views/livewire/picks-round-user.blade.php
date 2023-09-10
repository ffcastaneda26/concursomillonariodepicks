<div class="mt-2">
    <td class="text-base">{{ $user->name }}</td>
    @foreach($user_picks_round as $user_pick_round)

        <td align="center">
            @if($user_pick_round->game->allow_pick())
                <img src="{{ asset('images/reloj.jpg') }}" alt="" width="32px" height="32px">
            @else
                @if($user_pick_round->winner== 1)
                    <img src="{{Storage::url($user_pick_round->game->local_team->logo)}}"  class="avatar-xs" alt="" width="25px" height="25px">
                @else
                    <img src="{{Storage::url($user_pick_round->game->visit_team->logo)}}"  class="avatar-xs" alt="" width="25px" height="25px">
                @endif
                <span>
                    <img src="{{ $user_pick_round->winner== $user_pick_round->game->winner  ?   asset('images/afirmativo.png') : asset('images/negativo.png')}}"
                                alt="{{$user_pick_round->winner== $user_pick_round->game->winner  ?  __('Yes') : 'No' }}"
                                height="12px"
                                width="12px">
                </span>
                @if($user_pick_round->selected)
                    <span class="bg-dark text-white text-center text-sm">SEL</span>
                @endif
            @endif
        </td>

    @endforeach

    <td class="text-base">{{ $user->hits_round($round->id)}}</td>
</div>


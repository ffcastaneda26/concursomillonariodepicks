<div>
    <td align="center">
        @if($allow_pick)
            <img src="{{ asset('images/reloj.jpg') }}" alt="" width="32px" height="32px">
        @else
            @if($has_result)
                <span>
                    <img src="{{ $hit_game  ? asset('images/afirmativo.png')
                                            : asset('images/negativo.png')}}"
                                height="16px"
                                width="16px"
                        >
                </span>
                <br>
            @endif

            @if($game_selected)
                @if($user_pick_round->winner== 1)
                    <img src="{{Storage::url($user_pick_round->game->local_team->logo)}}"  class="avatar-xs">
                @else
                    <img src="{{Storage::url($user_pick_round->game->visit_team->logo)}}"  class="avatar-xs">
                @endif
            @else
                @if($user_pick_round->winner== 1)
                    <label class="text-black text-center">{{ $user_pick_round->game->local_team->short }}</label>
                @else
                    <label class="text-black text-center">{{ $user_pick_round->game->visit_team->short }}</label>
                @endif
            @endif
        @endif
    </td>
</div>

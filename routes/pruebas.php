<?php

use App\Models\Game;
use App\Models\Pick;
use App\Models\User;
use App\Models\Round;
use App\Models\Entidad;
use App\Models\Profile;
use App\Models\Position;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Factory;

Route::get('update_allow_picks',function(){
    $round = new Round();
    $current_round = $round->read_current_round();
    $games = Game::where('round_id','>=',$current_round->id)->get();
    
});

Route::get('carga-inicial',function(){
    echo '<h1> CARGA INICIAL...................</h1>';
    echo '<h1> PROCESO YA FUE EJECUTADO </h1>';
    die();
    DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
    $user_roles = DB::table('user_roles')->where('role_id','>',7)->count();
    $users = User::where('id','>',7)->orderBy('id')->get();
    DB::table('user_roles')->where('role_id', 2)->delete();
    echo '<h3> Roles de Usuarios Eliminados ='  . $user_roles. '<h3>' ;

    echo '<hr>';
    $i=0;

    echo '<h3> Asignando  rol de participante a '  . $users->count(). ' usuarios <h3>' ;
    foreach($users as $user){
        $user->assignRole(env('ROLE_TO_PARTICIPANT','participante'));

        if($i == 0){

            echo 'Se crearán los PRONOSTICOS de todos los usuarios participantes<br>';
        }

        $games = Game::whereDoesntHave('picks', function (Builder $query) use ($user) {
            $query->where('user_id',$user->id);
            })->get();

        foreach($games as $game){
            $winner = mt_rand(1,2);
            $new_pick = Pick::create([
                'user_id'   => $user->id,
                'game_id'   => $game->id,
                'winner'    => $winner
                ]);

            $points = mt_rand(0,47);
            if($game->is_last_game_round()){
                if($winner == 1){
                    $new_pick->local_points = $points;
                    $new_pick->visit_points = 0;
                }else{
                    $new_pick->local_points = 0;
                    $new_pick->visit_points = $points;
                }
                $new_pick->total_points = $points;
            }
            $new_pick->save();
        }

        if($i == 0){
            echo 'Se crearán los POSICIONES de todos los usuarios participantes<br>';
        }

        $rounds = Round::whereDoesntHave('positions', function (Builder $query) use($user) {
            $query->where('user_id',$user->id);
            })->get();

        foreach($rounds as $round){
            if(!$user->has_position_record_round($round->id)){
                $new_position_record = new Position();
                $new_position_record->round_id = $round->id;
                $new_position_record->user_id = $user->id;
                $new_position_record->save();
            }
        }
        echo 'Encriptando clave usuario Id=' . $user->id . '=' . $user->name . '<br>';
        $user->password = Hash::make($user->password);

        $user->save();

        $i++;
    }

    echo '<h3>Pronósticos creados' . '</h3>';
    echo '<hr>';
    echo '<h3>Encriptamos las claves' . '</h3>';


});

Route::get('actualiza_passwords',function(){
    $sql = "UPDATE users SET password='" . Hash::make('password') . "';";
    DB::update($sql);
    echo 'Los passwords han sido actualizados......' . '<br>';
});


Route::get('califica/',function(){
    date_default_timezone_set(env('TIMEZONE','America/Chihuahua'));
    $game = Game::findOrFail(65);
    $year_game      = substr($game->game_day,0,4);
    $month_game     = substr($game->game_day,5,2);
    $day_game       = substr($game->game_day,8,2);
    $hour_game      = substr($game->game_time,0,2);
    $minutes_game   = substr($game->game_time,3,2);
    $d = mktime($hour_game,$minutes_game,00,$month_game,$day_game,$year_game);
    echo 'Veamos='. date("w", $d);
    dd('El número de día es: ' . $d);
    echo date('w');
});

Route::get('/juegos_sin_pronostico_usuario_conectado',function(){
    $games = game::whereDoesntHave('picks', function (Builder $query) {
        $query->where('user_id',Auth::user()->id);
    })->get();
    dd($games);
});

Route::get('/usuarios_rol/{role}',function($role){

    $users = User::role($role)->get();
    dd($users);
});

Route::get('usuarios_sin_puntos_x_jornada/{round}',function($round){
    Artisan::call('optimize:clear');
    Artisan::call('cache:clear');
    $users = User::role('participante')->whereDoesntHave('positions',function($query) use ($round) {
        $query->where('round_id',$round);
    })->get();
    dd($users->count());

});

Route::get('sumar_aciertos/{round}',function(Round $round){


    $users = User::role('participante')
                ->select('users.id as user_id','rounds.id as round_id',DB::raw('SUM(picks.hit) as hits'))
                ->Join('picks', 'picks.user_id', '=', 'users.id')
                ->Join('games', 'picks.game_id', '=', 'games.id')
                ->Join('rounds', 'games.round_id', '=', 'rounds.id')
                ->where('games.round_id',$round->id)
                ->where('users.active','1')
                ->groupBy('users.id')
                ->groupBy('rounds.id')
                ->get();

    if(!empty($users)){
        foreach($users as $user){
            dd('user_id=' . $user->user_id. ' round_id=' . $user->round_id . ' Aciertos=' . $user->hits);
        }
    }


});

Route::get('posiciones',function(){
    $positions = Position::orderbyDesc('hits')
                         ->orderby('created_at')
                         ->get();
    echo '<table border="1">';
    echo '<tr><th>CORREO</th><th>ACIERTOS</th></tr>';

        foreach($positions as $position){
            echo '<tr>';
                echo '<td>' . $position->user->name . '</td>';
                echo '<td>' . $position->hits . '</td>';
            echo '</tr>';
        }

    echo '</table>';
});


Route::get('tabla-posiciones',function(){
    $positions = User::role('participante')
                        ->select('users.first_name',
                                'users.last_name',
                                DB::raw('SUM(positions.hits) as hits'),
                                DB::raw('SUM(positions.hit_last_game)    as hit_last_games'),
                                DB::raw('SUM(positions.dif_total_points) as dif_total_points'))
            ->Join('positions', 'positions.user_id', '=', 'users.id')
            ->where('users.active','1')
            ->groupBy('users.id')
            ->orderby('hits')
            ->orderby('hit_last_games')
            ->orderby('dif_total_points')
            ->paginate(15);
    dd($positions);
});


Route::get('crear-perfil/{user}',function(User $user){
    $datos = User::orderBy('id','DESC')->limit(20)->get();
    dd($datos);
    dd( $user->create_missing_picks());

    $entidad = Entidad::all()->random();
    dd($entidad,$entidad->municipios->random());
    if(!$user->profile){
        $profile = new Profile();
        $profile->user_id = $user->id;
        $profile->save();

    }
    $user->refresh();
    dd($user->profile);
    dd($user->first_name . ' ' . $user->last_name. '->' . $user->email);
});

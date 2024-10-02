/*
+--------------------+
|  Día semana MySql |
|   DAYOFWEEK       |
+-------------------+
|   Día     |   No. |
+-----------+-------+
| Domingo   |   1   |
| Lunes     |   2   |
| Martes    |   3   |
| Miércoles |   4   |
| Jueves    |   5   |
| Viernes   |   6   |
| Sábado    |   7   |
+-----------+-------+
*/
SELECT 'Domingo',DAYOFWEEK('2024-09-01') AS Numdia
UNION
SELECT 'Lunes',DAYOFWEEK('2024-08-26') AS Numdia
UNION
SELECT 'Martes',DAYOFWEEK('2024-08-27') AS Numdia
UNION
SELECT 'Miércoles',DAYOFWEEK('2024-08-28') AS Numdia
UNION
SELECT 'Jueves',DAYOFWEEK('2024-08-29') AS Numdia
UNION
SELECT 'Viernes',DAYOFWEEK('2024-08-30') AS Numdia
UNION
SELECT 'Sábado',DAYOFWEEK('2024-08-31') AS Numdia

/* Actualiza como Seleccionable los partidos de Domingo y Lunes */
USE concursomillonariodepicks;
UPDATE games
SET selectable = CASE
    WHEN DAYOFWEEK(game_day) IN (1, 2) THEN 1  -- Domingo (1) y Lunes (2)
    ELSE 0
END;

-- Usuarios con pronósticos diferentes a 272
SELECT us.id,us.name,count(*)
FROM users us,picks pic
WHERE us.id = pic.user_id
GROUP BY pic.user_id
HAVING count(*) != 272

user_id IN (271,283)
-- Partidos seleccionados
SELECT ga.id as GAMID,
	ga.round_id as JORNADA,
    ga.game_day as FECHA,
    ga.game_time as HORA,
	if(pic.selected,"SI","NO") as 'Seleccionado',
	us.name,
	tv.name AS 'Visita',
    tl.name AS 'Local',
	pic.visit_points AS 'Puntos Visita',
	pic.local_points AS 'Puntos Local',
	ga.handicap AS 'Pts Ventaja',
	(pic.local_points + ga.handicap) as "Comparar",
	if(pic.local_points + ga.handicap > pic.visit_points,1,2) AS 'Calculado',
	pic.winner as "Pronosticado"
FROM users us, games ga, teams tv, teams tl, picks pic
WHERE us.id = pic.user_id
  AND tv.id = ga.visit_team_id
  AND tl.id = ga.local_team_id
  AND ga.id = pic.game_id
  AND pic.selected
  AND pic.user_id = 271
ORDER BY us.name;

-- Actualizar los picks de un usuario de una jornada
UPDATE picks SET selected = 1
WHERE user_id = 271
  AND game_id  IN (38,39,40,42,43);

UPDATE picks
SET pic.visit_points = 7,pic.local_points=21,winner=1
WHERE pic_user = 271
  AND game_id = 48;

-- Datos del MNF de un usuario y una jornada
SELECT ga.id as GAMID,
	ga.round_id as JORNADA,
    ga.game_day as FECHA,
    ga.game_time as HORA,
	if(pic.selected,"SI","NO") as 'Seleccionado',
	us.name,
	tv.name AS 'Visita',
    tl.name AS 'Local',
	pic.visit_points AS 'Puntos Visita',
	pic.local_points AS 'Puntos Local',
	ga.handicap AS 'Pts Ventaja',
	(pic.local_points + ga.handicap) as "Comparar",
	if(pic.local_points + ga.handicap > pic.visit_points,1,2) AS 'Calculado',
	pic.winner as "Pronosticado"
FROM users us, games ga, teams tv, teams tl, picks pic
WHERE us.id = pic.user_id
  AND tv.id = ga.visit_team_id
  AND tl.id = ga.local_team_id
  AND ga.id = pic.game_id
  AND pic.user_id = 104
  AND round_id = 4
  AND (pic.local_points IS NOT NULL OR pic.visit_points IS NOT NULL)
  AND Calculado != Pronosticado
ORDER BY us.name;



-- Asigna a todos los usuarios clave= password
UPDATE users SET password='$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';


---- ANALISIS DE PRONOSTICOS DEL PARTIDO DE DESEMPATE -
---- Mostrar pronósticos erróneos en un juego según untos de ventaja del juego
SELECT ga.id as GAMID,
	ga.round_id as JORNADA,
    ga.game_day as FECHA,
    ga.game_time as HORA,
	if(pic.selected,"SI","NO") as 'Seleccionado',
	us.name,
	tv.name AS 'Visita',
    tl.name AS 'Local',
	pic.visit_points AS 'Puntos Visita',
	pic.local_points AS 'Puntos Local',
	ga.handicap AS 'Pts Ventaja',
	(pic.local_points + ga.handicap) as "Comparar",
	if(pic.local_points + ga.handicap > pic.visit_points,1,2) AS 'Calculado',
	pic.winner as "Pronosticado"
FROM users us, games ga, teams tv, teams tl, picks pic
WHERE us.id = pic.user_id
  AND tv.id = ga.visit_team_id
  AND tl.id = ga.local_team_id
  AND ga.id = pic.game_id
  AND if(pic.local_points + ga.handicap > pic.visit_points,1,2) <> pic.winner
  AND (pic.local_points IS NOT NULL OR pic.visit_points IS NOT NULL)
ORDER BY us.name;

-- Partidos que traen diferencias
SELECT distinct ga.id
FROM users us, games ga, teams tv, teams tl, picks pic
WHERE us.id = pic.user_id
  AND tv.id = ga.visit_team_id
  AND tl.id = ga.local_team_id
  AND ga.id = pic.game_id
  AND if(pic.local_points + ga.handicap > pic.visit_points,1,2) <> pic.winner
  AND (pic.local_points IS NOT NULL OR pic.visit_points IS NOT NULL)
ORDER BY us.name;


-- Actualizar si hay diferencias
USE concursomillonariodepicks;
UPDATE  users us,games ga,picks pic set pic.winner = if(pic.local_points + ga.handicap > pic.visit_points,1,2)
WHERE us.id = pic.user_id
  AND ga.id = pic.game_id
  AND ga.id IN (16)
  AND if(pic.local_points + ga.handicap >= pic.visit_points,1,2) <> pic.winner


  -- Listado de pronósticos que se actualizó el WINNER
  SELECT     if(pic.selected,"SI","NO") as 'Seleccionado',
	us.name,
	tv.name AS 'Visita',
    tl.name AS 'Local',
	pic.visit_points AS 'Puntos Visita',
	pic.local_points AS 'Puntos Local',
	ga.handicap AS 'Pts Ventaja',
	(pic.local_points + ga.handicap) as "Comparar",
	if(pic.local_points + ga.handicap > pic.visit_points,1,2) AS 'Calculado',
	pic.winner as "Pronosticado"
FROM users us, games ga, teams tv, teams tl, picks pic
WHERE us.id = pic.user_id
  AND tv.id = ga.visit_team_id
  AND tl.id = ga.local_team_id
  AND ga.id = pic.game_id
  AND ga.id IN (16,32)
  AND pic.created_at != pic.updated_at
  AND DATE_FORMAT(pic.updated_at, "%Y-%m-%d") = '2024-09-17'
ORDER BY us.name;


--- SQL QUE SE DEBE EJECUTAR EN EL SERVIDOR --
UPDATE  users us,games ga,picks pic set pic.winner = if(pic.local_points + ga.handicap > pic.visit_points,1,2) 
WHERE us.id = pic.user_id   
  AND ga.id = pic.game_id  
  AND pic.local_points IS NOT NULL  
  AND pic.visit_points IS NOT NULL   
  AND if(pic.local_points + ga.handicap >= pic.visit_points,1,2) <> pic.winner
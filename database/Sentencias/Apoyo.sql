
TRUNCATE positions;
TRUNCATE picks;


SELECT 'Pronósticos=' as Tipo,COUNT(*) as total FROM picks
UNION
SELECT 'Posiciones=' as Tipo,COUNT(*) as total FROM positions;|

---
SELECT vt.short AS VISITANTE,
 		 lt.short AS VISITANTE,
       ga.id,ga.winner,
		 if(ga.winner=1,'Local','Visita') AS Ganador,
		 IF(pic.winner=1,'Local','Visita') AS PROOSTICO_QUIEN_GANA,
		 pic.winner AS PRONOSTICOX,
		 if(ga.winner=pic.winner,'Acerttó','Falló') AS Resultado,
		 pic.local_points AS "PRONOSTICO PUNTOS LOCALES",
		 pic.visit_points AS "PRONOSTICO PUNTOS VISITA",
		 pic.id AS "PIC_ID"
FROM games ga,picks pic,teams lt,teams vt
WHERE ga.id = pic.game_id
  AND lt.id = ga.local_team_id
  AND vt.id = ga.visit_team_id
  AND ga.round_id = 2
  AND (ga.local_team_id = 1 OR ga.visit_team_id = 1)

---
SELECT concat(us.first_name,' ',us.last_name) as nombre,
		lt.name as local,
        vt.name as visita,
		pi.winner as pronosticó,
        ga.winner as resultado,
        if (pi.winner = ga.winner,"SI","NO") as ACERTÓ
FROM users us,picks pi,games ga,teams lt,teams vt
WHERE us.id = pi.user_id
  AND ga.id = pi.game_id
  AND lt.id = ga.local_team_id
  AND vt.id = ga.visit_team_id
  AND pi.game_id BETWEEN 1 AND 5;
--
UPDATE games
SET local_points = NULL,visit_points = NULL;


----- ACIERTOS DE JUEGOS DE UNA JORNADA ----
SELECT ga.id ,CONCAT(us.first_name,' ', us.last_name) AS PARTICIPANTE ,
		tv.name AS VISITA,ga.visit_points,
		tl.name AS LOCAL,ga.local_points,
		if(pic.winner=1,"LOCAL","VISITA") AS pronóstico,
		if(ga.winner = pic.winner,"Acertó","Falló") AS RESULTADO,
		pic.local_points AS PRON_LOCAL,
		pic.visit_points AS PRON_VISITA
FROM games ga,picks pic,teams tv,teams tl,users us
WHERE ga.id = pic.game_id
  AND tv.id = ga.visit_team_id
  AND tl.id = ga.local_team_id
  AND us.id = pic.user_id
  AND ga.round_id = 1


-----

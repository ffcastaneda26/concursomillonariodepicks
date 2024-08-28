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


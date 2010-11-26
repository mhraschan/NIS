SELECT p.name, a.a_name FROM Persons p 
	INNER JOIN Persons_Abilities pa 
	ON p.p_nr = pa.Persons_p_nr
	INNER JOIN Abilities a
	ON pa.Abilities_a_id = a.a_id
	WHERE p.name = 'Otto';

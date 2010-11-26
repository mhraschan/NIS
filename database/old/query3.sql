SELECT o.o_name, o.max_participants FROM Offers o
	INNER JOIN Offer_Abilities oa ON o.o_id = oa.Offers_o_id
	INNER JOIN Abilities a ON a.a_id = oa.Abilities_a_id
	WHERE a.a_id IN(
		SELECT a2.a_id FROM Abilities a2
		 INNER JOIN Persons_Abilities pa ON pa.Abilities_a_id = a2.a_id
		 INNER JOIN Persons p ON pa.Persons_p_nr = p.p_nr
	   WHERE p.name = 'Otto')
	GROUP BY o.o_name
	HAVING o.max_participants > 10;

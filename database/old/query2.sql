SELECT p.name FROM Persons p
	WHERE p.p_nr IN 
		(SELECT a.Persons_p_nr FROM Accountings a 
			INNER JOIN Offers o ON a.Offers_o_id = o.o_id
			WHERE a.date = '2009-11-24' 
			AND o.o_name ='Surfing');

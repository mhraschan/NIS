INSERT IGNORE INTO `Abilities` VALUES 
(3, 'fliegen'),
(4, 'tauchen'),
(1, 'Programing'),
(2, 'skiing'),
(5, 'kite-surfing'),
(10, 'everything');

INSERT IGNORE INTO `Accountings` VALUES 
(1, 3, 1, '2009-11-24'),
(2, 3, 3, '2009-11-24'),
(3, 2, 3, '2010-04-23'),
(4, 1, 1, '2011-01-05');

INSERT IGNORE INTO `Offer_Abilities` VALUES 
(3, 1),
(3, 4),
(4, 2),
(1, 1),
(1, 2),
(1, 4),
(1, 5),
(2, 3),
(2, 6);

INSERT IGNORE INTO `Offers` VALUES 
(1, 'flug_ryanair', 120),
(2, 'tauchgang_malediven', 10),
(3, 'Surfing', 100),
(4, 'skydiving', 6),
(5, 'BASE-jumping', 200),
(6, 'Google', 19),
(7, 'IBM_Project', 19),
(8, 'Atomic_Racing', 20),
(9, 'Google2', 19),
(10, 'IBM_Project2', 19),
(11, 'ski-race3', 18);

INSERT IGNORE INTO `Persons` VALUES 
(1, 'Huber'),
(2, 'Otto'),
(3, 'Maxmann'),
(4, 'mviertler'),
(5, 'mhraschan'),
(6, 'fachleitner');

INSERT IGNORE INTO `Persons_Abilities` VALUES 
(1, 4),
(2, 3),
(4, 1),
(4, 2),
(4, 3),
(5, 1),
(6, 10),
(6, 3);

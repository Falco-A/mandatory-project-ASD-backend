CREATE TABLE `users` (
   `id` int(11) NOT NULL,
   `username` varchar(20) NOT NULL,
   `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'Alessio', '123456'),
(2, 'Gennaro', '8_dita_rimanenti'),
(3, 'Ciro', 'orologio');

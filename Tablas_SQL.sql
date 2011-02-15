#
create table ligas ( 
id smallint(5) unsigned not null auto_increment, 
nombre varchar(30) not null, 
fecha varchar(10) not null, 
cantjug smallint(5) not null , 
jugadores varchar(1100) not null, 
creador varchar(20) not null,
estado smallint(1) not null,
primary key (id), 
key (cantjug,creador) 
);

create table invitacion ( 
id smallint(5) unsigned not null auto_increment, 
jugador varchar(20) not null, 
liga varchar(30) not null, 
fecha varchar(10) not null, 
invitador varchar(10) not null, 
primary key (id), 
key (jugador,liga) 
);


#La tabla lleva de prefijo nombre de la liga
create table jugadores ( 
id smallint(5) unsigned not null auto_increment, 
fecha varchar(10) not null, 
jugador varchar(20) not null, 
puntos int(10) unsigned not null, 
patidos int(10) unsigned not null, 
gpartidos int(10) unsigned not null, 
epartidos int(10) unsigned not null, 
ppartidos int(10) unsigned not null, 
golesF int(10) unsigned not null, 
golesE int(10) unsigned not null, 
rango smallint(1) not null,
primary key (id), 
key (jugador,rango) 
);

#La tabla lleva de prefijo nombre de la liga
create table partidos ( 
id smallint(5) unsigned not null auto_increment, 
fecha varchar(10) not null,
ganador varchar(50) not null, 
perdedor varchar(50) not null, 
golesG int(10) unsigned not null, 
golesP int(10) unsigned not null,
empate varchar(2) not null, 
ip varchar(15) not null,
creador varchar(20) not null,
primary key (id), 
key (ganador,perdedor,empate) 
);

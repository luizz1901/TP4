create database trabalho_pw2;

use trabalho_pw2;


create table tbgenero (
    idGenero int auto_increment primary key,
    nomeGenero varchar(100) not null
);


create table tbartbanda (
    id int AUTO_INCREMENT primary key,
    nome varchar(100) not null,
    descricao varchar(200) not null,
    precoShow decimal(10, 2) not null,
    foto varchar(255) not null,
    idGenero int not null,
    foreign key (idGenero) references tbgenero (idGenero)
);

create table tbusuarios (
    idUser int AUTO_INCREMENT primary key,
    nome varchar(100) not null,
    senha varchar(100) not null,
    foto varchar(100) not null
);

insert into
    tbgenero
values
    (null, 'Rock'),
    (null, 'Metal'),
    (null, 'Pop'),
    (null, 'Eletronica'),
    (null, 'Romantica');

create table tbmusica (
    idMusica int auto_increment primary key,
    nome varchar(100) not null,
    duracao float not null,
    DtCriacao date not null,
    foto varchar(255) not null,
    id int not null,
    foreign key (id) references tbartbanda (id)
);

create table tbplaylist (
    idPlaylist int auto_increment primary key,
    nome varchar(100) not null,
    foto varchar(100) not null,
    idUser int not null,
    foreign key (idUser) references tbusuarios (idUser) on delete cascade
);

create table tbmusicaplaylist (
    idPlaylist int not null,
    idMusica int not null,
    primary key (idPlaylist, idMusica),
    foreign key (idPlaylist) references tbplaylist (idPlaylist) on delete cascade,
    foreign key (idMusica) references tbmusica (idMusica) on delete cascade
);
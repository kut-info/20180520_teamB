create database test;

create table title (id int not null auto_increment, title varchar(255), primary key (id));

create table time (hid int not null auto_increment, id int not null, start datetime default current_timestamp, end datetime default current_timestamp, primary key (hid));
create database api;

user api;

create table student(
	id int not null auto_increment primary key,
	name varchar(100) not null,
	email varchar(200) not null,
	mobno varchar(20) not null,
	address varchar(200) not null,
	coarses varchar(200) not null
)
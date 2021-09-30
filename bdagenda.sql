create database agenda;
use agenda;

create table user_(
user_id bigint auto_increment not null,
user_name varchar(100) not null,
user_pass varchar(45) not null,
primary key(user_id)
);

create table note(
id_ bigint auto_increment not null,
title_ varchar(100),
desc_ varchar(300),
is_finished boolean,
user_id bigint,
constraint fk_agenda_user_ foreign key (user_id) references agenda.user_ (user_id),
primary key(id_,user_id) 

);
/*
create table task_list(
id_ bigint auto_increment not null,
title_ varchar(100),
desc_ varchar(300),
is_finished boolean,
user_id bigint,
CONSTRAINT fk_agenda_user_
FOREIGN KEY (user__user_id)
REFERENCES agenda.user_ (user_id),
primary key(id_,user_id) 

);
*/
-- drop table note;
-- drop table user_;
insert into user_(user_name,user_pass) values("usuario01","1234"),("usuario02","5678"),("usuario03","9012");
insert into note(title_,desc_,is_finished,user_id) values ("compras"," fazer as compras, nao esqueser de deixar o gato no petshop ",false,1),
("Trabalho","colocar o sistema no ar",true,3),("Para o Final de Semana","Laver o carro e a moto",false,2);

delete from user_ where user_id=2;
delete from note where id_ = 3;
select * from user_;
select * from note;

select * from user_ where user_id = 1;


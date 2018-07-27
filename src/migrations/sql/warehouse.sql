create table if not exists `warehouse` (
    `id` int(10) unsigned not null auto_increment,
    `name` varchar(255) not null,
    `owner` varchar(255) not null,
    primary key (id)
)
engine = innodb
auto_increment = 1
character set utf8
collate utf8_general_ci;

insert into `warehouse` (`name`, `owner`) values 
    ('Склад бабы Зины', 'zina'),
    ('Склад бабы Вали', 'valya'),
    ('Склад робота', 'robot')
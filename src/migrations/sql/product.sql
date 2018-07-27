create table if not exists `product` (
    `id` int(10) unsigned not null auto_increment,
    `name` varchar(255) not null,
    `price` int(16) not null,
    `amount` int(16) not null,
    `category` int(10),
    `warehouse_id` int(10) not null,
    primary key (id)
)
engine = innodb
auto_increment = 1
character set utf8
collate utf8_general_ci;

insert into `product` (`name`, `price`, `amount`, `warehouse_id`) values 
    ('Продукт 1', 0, 20, 1),
    ('Продукт 2', 0, 30, 2),
    ('Продукт 3', 0, 40, 3)
    
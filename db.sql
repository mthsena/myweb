drop table if exists `accounts`;
create table `accounts` (
  `id` int(10) unsigned not null auto_increment,
  `name` varchar(255) not null default '',
  `email` varchar(255) not null default '',
  `password` varchar(255) not null default '',
  `role` int(10) unsigned not null default 0,
  `createdAt` int(10) unsigned not null default 0,
  primary key (`id`)
) engine=innodb default charset=utf8;
insert into `accounts` values (1, 'Admin', 'admin@admin.com', 'c8e5bb0f9e9c456998d4a6d7b6918f84dcc317e22a798b28752a65f89d722360', 1, 1602591754);

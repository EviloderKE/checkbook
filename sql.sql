use laravel;

drop table if exists `records`;
create table `records`(
  `id` int unsigned not null primary key auto_increment comment '主键',
  `user_id` int unsigned not null comment '用户id',
  `type` tinyint unsigned not null default 1 comment '记录类型',
  `datetime` datetime not null comment '记录时间',
  `action` tinyint not null default 1 comment '方式',
  `amount` decimal(10,2) not null comment '金额',
  `tag` tinyint unsigned not null default 1 comment '标签',
  `note` varchar(200) not null default '' comment '备注',
  `created_at` datetime not null comment '写入时间',
  `updated_at` datetime not null comment '更新时间',
  `deleted_at` datetime default null comment '删除时间'
)engine=innodb charset=utf8

drop table if exists `category`;
create table `category`(
    `id` int unsigned not null primary key auto_increment,
    `name` varchar(255) not null default '' comment '分类名称'
)engine=InnoDB charset=utf8 comment='分类表';
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
  `is_delete` tinyint unsigned not null default 0 comment '是否删除'
)engine=innodb charset=utf8
create table uploads(  
     labler_id int (32) primary key not null auto_increment,
     userid int (32) not null,  
     username varchar(32) not  null , 
	 usersex varchar(32) not null,
	 userage varchar(32) not null,
	 is_normal varchar(32) not null,
     userstatic varchar(32) not  null,
     usertaimei varchar(16) not  null,
     userzhoumei varchar(16) not null,
     userbiyan varchar(16) not null,
     usersongbi varchar(16) not null,
     userweixiao varchar(16) not null,
     usershichi varchar(16) not null,
     usergusai varchar(32) not null,
	 labler varchar(32) not null
     );
create table photo_video(
    id int (32) primary key not null auto_increment,
	static_p varchar(32) not  null,
	taimei_p varchar(32) not  null,
	taimei_v varchar(32) not  null,
	zhoumei_p varchar(32) not  null,
	zhoumei_v varchar(32) not  null,
	biyan_p varchar(32) not  null,
	biyan_v varchar(32) not  null,
	songbi_p varchar(32) not  null,
	songbi_v varchar(32) not  null,
	weixiao_p varchar(32) not  null,
	weixiao_v varchar(32) not  null,
	shichi_p varchar(32) not  null,
	shichi_v varchar(32) not  null,
	gusai_p varchar(32) not  null,
	gusai_v varchar(32) not  null
     );
create table register(
     register_name varchar(32) primary key not null,
     password varchar(32) not null,
     phone varchar(32) not null,
	 post_id varchar(32) not null
);
create table upload_labler(
    id int (32) primary key not null,
	name varchar(32) not null,
	sex varchar(32) not null,
	age varchar(32) not null,
	is_normal varchar(32) not null,
	labler varchar(32) not null,
	labler_count varchar(32) not null,
	foreign key(id) references photo_video(id) on delete cascade on update cascade
);
create table register_post(
    id int(32) primary key not null,
	post_id varchar(32) not null,
	rule_name varchar(32) not null
);
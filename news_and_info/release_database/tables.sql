/* 
 * Table: country
 */

DROP TABLE IF EXISTS country;
CREATE TABLE country (
	country_code char(3) NOT NULL,
	country_name varchar(25) NOT NULL,
	PRIMARY KEY (country_code),
	KEY idx_country_code (country_code),
	UNIQUE unq_country_code (country_code)
);


/*
 * Table: format
 */

DROP TABLE IF EXISTS format;
CREATE TABLE format (
	format_code char(3) NOT NULL,
	format_name varchar(25) NOT NULL,
	format_desc text,
	PRIMARY KEY (format_code),
	KEY idx_format_code (format_code),
	UNIQUE unq_format_code (format_code)
);

/*
 * Table: rel_type
 */

DROP TABLE IF EXISTS rel_type;
CREATE TABLE rel_type (
	rel_type_code char(3) NOT NULL,
	rel_type_name varchar(25) NOT NULL,
	rel_type_desc text,
	PRIMARY KEY (rel_type_code),
	KEY idx_rel_type_code (rel_type_code),
	UNIQUE unq_rel_type_code (rel_type_code)
);

/*
 * Table: rec_label
 */

DROP TABLE IF EXISTS rec_label;
CREATE TABLE rec_label (
	rec_label_code char(3) NOT NULL,
	rec_label_name varchar(25) NOT NULL,
	rec_label_desc text,
	PRIMARY KEY (rec_label_code),
	KEY idx_rec_label_code (rec_label_code),
	UNIQUE unq_rec_label_code (rec_label_code)
);

/*
 * Table: track
 */

DROP TABLE IF EXISTS track;
CREATE TABLE track (
	track_id int(4) DEFAULT '0' NOT NULL auto_increment,
	track_name varchar(80) NOT NULL,
	track_length varchar(5),
	PRIMARY KEY (track_id),
	KEY idx_track_id (track_id),
	UNIQUE unq_track_id (track_id)
);

/*
 * Table: track_rel_mpg
 */

DROP TABLE IF EXISTS track_rel_mpg;
CREATE TABLE track_rel_mpg (
	track_rel_mpg_id int(8) DEFAULT '0' NOT NULL auto_increment,
	track_id int(4) NOT NULL,
	rel_id int(4) NOT NULL,
	rel_order int(4) NOT NULL,
	PRIMARY KEY (track_rel_mpg_id),
	KEY idx_track_rel_mpg_id (track_rel_mpg_id),
	UNIQUE unq_track_rel_mpg_id (track_rel_mpg_id),
	KEY idx_track_id (track_id),
	KEY idx_rel_id (rel_id)
);

DROP TABLE IF EXISTS release;
CREATE TABLE release (
	release_id int(4) DEFAULT '0' NOT NULL auto_increment,
	release_name varchar(80) NOT NULL,
	release_no_tracks int(4) NOT NULL,
	release_label varchar(3) NOT NULL,
	release_country_sale varchar(3) NOT NULL,
	release_country_manu varchar(3),
	release_date date,
	release_year year NOT NULL,
	release_format varchar(3) NOT NULL,
	release_type varchar(3) NOT NULL,
	release_notes text,
	release_pic_slv enum('Y','N') NOT NULL,
	release_cover_url varchar(80),
	release_cover_desc text,
	release_bar_code varchar(20),
	release_code_1 varchar(20) NOT NULL,
	release_code_2 varchar(20),
	release_code_3 varchar(20),
	release_code_4 varchar(20),
	release_code_5 varchar(20),
	release_code_6 varchar(20),
	release_cb_code varchar(10),
	release_lc_code varchar(10),
	PRIMARY KEY (release_id),
	KEY idx_release_id (release_id),
	UNIQUE unq_release_id (release_id),
	KEY idx_release_name (release_name),
	KEY idx_release_code_1 (release_code_1),
	KEY idx_name_country (release_name, release_country_sale)
);
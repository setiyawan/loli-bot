# survey

Get All City
/loli-bot/index.php/c_city

Get Top List city
/loli-bot/index.php/c_city/topList/?count=1

Get Wisata detail
/loli-bot/index.php/c_wisata/detail?id_wisata=2&id_daerah=1

# Database
CREATE TABLE ms_akun
(
  user_id serial NOT NULL,
  nama character varying(50),
  username character varying(20),
  password character varying(100),
  jenis_user integer, -- 1. admin...
  status integer, -- 1. aktif...
  CONSTRAINT ms_akun_pkey PRIMARY KEY (user_id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE ms_akun
  OWNER TO postgres;
COMMENT ON COLUMN ms_akun.jenis_user IS '1. admin
2. client';
COMMENT ON COLUMN ms_akun.status IS '1. aktif
2. nonaktif';


CREATE TABLE ms_daerah
(
  id_daerah serial NOT NULL,
  provinsi character varying(30),
  kota character varying(30),
  status integer, -- 
  create_by integer,
  create_time time without time zone,
  update_by integer,
  update_time time without time zone,
  points integer,
  CONSTRAINT ms_daerah_pkey PRIMARY KEY (id_daerah)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE ms_daerah
  OWNER TO postgres;
COMMENT ON COLUMN ms_daerah.status IS '
';


CREATE TABLE ms_wisata
(
  id_wisata integer NOT NULL DEFAULT nextval('wisata_id_wisata_seq'::regclass), -- 
  id_daerah integer,
  nama character varying(100),
  pengelola character varying(50),
  alamat text,
  lokasi character varying(100), -- save longitude and lattitude
  jam_buka text,
  htm numeric(10,0),
  jenis_wisata integer, -- 1. kuliner...
  keterangan text,
  status integer,
  create_by integer,
  create_time time without time zone,
  update_by integer,
  update_time time without time zone,
  link_gambar character varying(100),
  CONSTRAINT wisata_pkey PRIMARY KEY (id_wisata),
  CONSTRAINT ms_wisata_id_daerah_fkey FOREIGN KEY (id_daerah)
      REFERENCES ms_daerah (id_daerah) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE ms_wisata
  OWNER TO postgres;
COMMENT ON COLUMN ms_wisata.id_wisata IS '
';
COMMENT ON COLUMN ms_wisata.lokasi IS 'save longitude and lattitude';
COMMENT ON COLUMN ms_wisata.jenis_wisata IS '1. kuliner
2. alam';


CREATE TABLE ms_detail_wisata
(
  id_detail_wisata serial NOT NULL,
  id_wisata integer,
  produk character varying(100),
  harga numeric(10,0),
  link_gambar character varying(100),
  keterangan text,
  status integer,
  create_by integer,
  create_time time without time zone,
  update_by integer,
  update_time time without time zone,
  CONSTRAINT ms_detail_wisata_pkey PRIMARY KEY (id_detail_wisata),
  CONSTRAINT ms_detail_wisata_id_wisata_fkey FOREIGN KEY (id_wisata)
      REFERENCES ms_wisata (id_wisata) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE ms_detail_wisata
  OWNER TO postgres;

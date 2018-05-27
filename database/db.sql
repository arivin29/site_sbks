INSERT INTO users
( name, email, password, tipe, status)
    SELECT
      nama_guru, nip || '@edutech.com','$2y$10$HD1UQmTr7AOTPGGhJ4pZZeWoSaCKwI0y3LyfAPXKCFM0KISsiEtP.','guru',1
FROM t_guru
WHERE nama_guru is NOT NULL;

SELECT
  a.id_murid_kelas,
  d.mata_pelajaran,
  a.smt,
  c.id_guru_mp,
  a.kelas_paralel,
  a.kelas,
  c.id_guru

FROM t_murid_kelas a,
  (SELECT max(id_murid_kelas) id_murid_kelas from t_murid_kelas WHERE id_murid=35) b,
  t_guru_mp c,
  m_mata_pelajaran d
WHERE a.id_murid_kelas=b.id_murid_kelas
and a.id_jurusan=c.id_jurusan
and a.kelas=c.kelas
and a.kelas_paralel=c.kelas_paralel
and c.id_mata_pelajaran=d.id_mata_pelajaran
and a.id_murid=35
and c.tahun_ajar='2017/2018';

SELECT b.jenis,
  a.nilai,
  a.nilai_akhir,
  a.batas_remedial,
  a.is_remedial,
  a.tanggal_rekap
FROM t_nilai a,
  m_jenis_nilai b
WHERE a.id_jenis_nilai=b.id_jenis_nilai
  and a.id_guru_mp=37
and id_murid=35
ORDER BY a.id_nilai ASC;

INSERT INTO users
( name, email, password, tipe, status,id_induk)
    SELECT
      max(nama_guru), max(nip) || '@edutech.com','$2y$10$HD1UQmTr7AOTPGGhJ4pZZeWoSaCKwI0y3LyfAPXKCFM0KISsiEtP.','guru',1,max(id_guru)
FROM t_guru
WHERE nama_guru is NOT NULL
GROUP BY nip;

DELETE FROM users WHERE tipe='guru';




DELETE FROM t_murid WHERE id_murid > 2698;

INSERT INTO users
( name, email, password, tipe, status,id_induk)
    SELECT
      max(nama_murid), max(nis) || '@edutech.com','$2y$10$HD1UQmTr7AOTPGGhJ4pZZeWoSaCKwI0y3LyfAPXKCFM0KISsiEtP.','ortu',1,max(id_murid)
FROM t_murid
WHERE t_murid.nama_murid is NOT NULL
GROUP BY nis;

DELETE FROM users WHERE tipe='ortu';

UPDATE t_murid_kelas as x
      SET  id_murid=a.id_murid
      FROM t_murid a
    WHERE a.nis=x.i_nis;

update t_murid SET no_hp='08XXXXXXXXX' , email ='XXXX@xxxxx.com' WHERE no_hp IS NULL ;


DROP TABLE IF EXISTS time_dimension;
CREATE TABLE time_dimension (
  id                      INTEGER PRIMARY KEY,  -- year*10000+month*100+day
  db_date                 DATE NOT NULL,
  year                    INTEGER NOT NULL,
  month                   INTEGER NOT NULL, -- 1 to 12
  day                     INTEGER NOT NULL, -- 1 to 31
  quarter                 INTEGER NOT NULL, -- 1 to 4
  week                    INTEGER NOT NULL, -- 1 to 52/53
  day_name                VARCHAR(9) NOT NULL, -- 'Monday', 'Tuesday'...
  month_name              VARCHAR(9) NOT NULL, -- 'January', 'February'...
  holiday_flag            CHAR(1) DEFAULT 'f' CHECK (holiday_flag in ('t', 'f')),
  weekend_flag            CHAR(1) DEFAULT 'f' CHECK (weekday_flag in ('t', 'f')),
  event                   VARCHAR(50),
  UNIQUE td_ymd_idx (year,month,day),
  UNIQUE td_dbdate_idx (db_date)

) Engine=MyISAM;

DROP PROCEDURE IF EXISTS fill_date_dimension;
DELIMITER //
CREATE PROCEDURE fill_date_dimension(IN startdate DATE,IN stopdate DATE)
  BEGIN
    DECLARE currentdate DATE;
    SET currentdate = startdate;
    WHILE currentdate < stopdate DO
      INSERT INTO time_dimension VALUES (
        YEAR(currentdate)*10000+MONTH(currentdate)*100 + DAY(currentdate),
        currentdate,
        YEAR(currentdate),
        MONTH(currentdate),
        DAY(currentdate),
        QUARTER(currentdate),
        WEEKOFYEAR(currentdate),
        DATE_FORMAT(currentdate,'%W'),
        DATE_FORMAT(currentdate,'%M'),
        'f',
        CASE DAYOFWEEK(currentdate) WHEN 1 THEN 't' WHEN 7 then 't' ELSE 'f' END,
        NULL);
      SET currentdate = ADDDATE(currentdate,INTERVAL 1 DAY);
    END WHILE;
  END
//
DELIMITER ;

TRUNCATE TABLE time_dimension;

CALL fill_date_dimension('2017-01-01','2019-12-12');
OPTIMIZE TABLE time_dimension;



SELECT
  a.id_murid_kelas,
  d.mata_pelajaran,
  a.smt,
  c.id_guru_mp,
  a.kelas_paralel,
  a.kelas,
  c.id_guru

FROM t_murid_kelas a,
  (SELECT max(id_murid_kelas) id_murid_kelas from t_murid_kelas WHERE id_murid=35) b,
  t_guru_mp c,
  m_mata_pelajaran d
WHERE a.id_murid_kelas=b.id_murid_kelas
and a.id_jurusan=c.id_jurusan
and a.kelas=c.kelas
and a.kelas_paralel=c.kelas_paralel
and c.id_mata_pelajaran=d.id_mata_pelajaran
and a.id_murid=35
and c.tahun_ajar='2017/2018';

SELECT b.jenis,
  a.nilai,
  a.nilai_akhir,
  a.batas_remedial,
  a.is_remedial,
  a.tanggal_rekap
FROM t_nilai a,
  m_jenis_nilai b
WHERE a.id_jenis_nilai=b.id_jenis_nilai
  and a.id_guru_mp=37
and id_murid=35
ORDER BY a.id_nilai ASC;

INSERT INTO users
( name, email, password, tipe, status,id_induk)
    SELECT
      max(nama_guru), max(nip) || '@edutech.com','$2y$10$HD1UQmTr7AOTPGGhJ4pZZeWoSaCKwI0y3LyfAPXKCFM0KISsiEtP.','guru',1,max(id_guru)
FROM t_guru
WHERE nama_guru is NOT NULL
GROUP BY nip;

DELETE FROM users WHERE tipe='guru';


DELETE FROM t_murid WHERE id_murid > 2698;

INSERT INTO users
( name, email, password, tipe, status,id_induk)
    SELECT
      max(nama_murid), max(nis) || '@edutech.com','$2y$10$HD1UQmTr7AOTPGGhJ4pZZeWoSaCKwI0y3LyfAPXKCFM0KISsiEtP.','ortu',1,max(id_murid)
FROM t_murid
WHERE t_murid.nama_murid is NOT NULL
GROUP BY nis;

DELETE FROM users WHERE tipe='ortu';

UPDATE t_murid_kelas as x
      SET  id_murid=a.id_murid
      FROM t_murid a
    WHERE a.nis=x.i_nis;

update t_murid SET no_hp='08XXXXXXXXX' , email ='XXXX@xxxxx.com' WHERE no_hp IS NULL ;

SELECT
a.*,
ibu.pekerjaan as pekerjaan_ibu,
bapak.pekerjaan as pekerjaan_bapak
FROM t_murid a
left join m_pekerjaan bapak on a.id_pekerjaan_ayah=bapak.id_pekerjaan
LEFT join m_pekerjaan ibu on a.id_pekerjaan_ibu=ibu.id_pekerjaan
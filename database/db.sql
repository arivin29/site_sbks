INSERT INTO users
( name, email, password, tipe, status)
    SELECT
      nama_guru, nip || '@edutech.com','$2y$10$HD1UQmTr7AOTPGGhJ4pZZeWoSaCKwI0y3LyfAPXKCFM0KISsiEtP.','guru',1
FROM t_guru
WHERE nama_guru is NOT NULL;


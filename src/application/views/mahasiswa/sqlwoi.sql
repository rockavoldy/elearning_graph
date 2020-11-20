CREATE TABLE tugas_topik(
    id_tugas int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_topik int NOT NULL,     
    id_ varchar(128),
    file_tugas varchar(128),
    FOREIGN KEY (id_topik) REFERENCES topik(id_topik)
);
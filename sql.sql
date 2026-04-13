use QuickRef;

UPDATE users set password='123456789' where id = 1;
select * from users ;
ALTER TABLE matchs MODIFY COLUMN statut VARCHAR(255) DEFAULT 'en_attente';
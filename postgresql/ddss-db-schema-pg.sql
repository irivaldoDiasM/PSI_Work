-- 
-- 
--    =========================================
--    Secure Software
--    =============== PSI 2022  ===============
--    ======== Practical Assignment #1 ========
--    =========================================
--
--      Universidade de Cabo Verde
--              University of Coimbra          
--   
--          Nuno Antunes <nmsa@dei.uc.pt>
--          Marco Vieira <mvieira@dei.uc.pt>
-- 
-- 

DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS messages;


CREATE TABLE users (
    username    VARCHAR( 32)    primary key,
    password    VARCHAR(512)    NOT NULL,
    salt        VARCHAR(512)    NOT NULL
);


CREATE TABLE messages (
    message_id  SERIAL PRIMARY KEY,
    author      VARCHAR( 16)   ,
    message     VARCHAR(256)    NOT NULL
);




-- Default data for messages
insert into users 
    values ('foobartee', 'foobar', 'foo');

insert into users 
    values ('batata', 'batata', 'batata');



-- Default data for messages
insert into messages (author, message)
          values ('Vulnerable', 'Hi! I wrote this message using Vulnerable Form.');

insert into messages (author, message)
          values ('Correct', 'OMG! This form is so correct!!!');

insert into messages (author, message)
          values ('Vulnerable', 'Oh really?');






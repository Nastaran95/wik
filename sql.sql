-- create DATABASE wikiderm;
use wikiderm;


DROP table Paper;
CREATE TABLE Paper(ID int NOT NULL AUTO_INCREMENT,
                  XMLNAME VARCHAR(300),
                  name VARCHAR(300) CHARACTER SET utf8 COLLATE utf8_general_ci,
                  writer VARCHAR(300) CHARACTER SET utf8 COLLATE utf8_general_ci,
                  Mokhtasar VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci,
                  image VARCHAR(1000),
                  time TIMESTAMP,
                  realtime VARCHAR(200),
                  mahbobiat int DEFAULT 0,
                  post_name VARCHAR(300) DEFAULT "",
                  dastebandi VARCHAR(300),
  PRIMARY KEY (ID)) DEFAULT CHARSET=utf8;


INSERT INTO Paper(XMLNAME, name,writer, Mokhtasar, image, time, realtime, mahbobiat, post_name, dastebandi) VALUES
  ('../XMLs/PaperXMLs/5b6d405a9a1fd5b6d405a9a222.xml','نام مقاله','اورهان پاموک','نام من سرخ (به ترکی استانبولی: Benim Adım Kırmızı) رمانی از اورهان پاموک است تحت تأثیر رمان مشهور ایتالیایی نام گل سرخ. نام من سرخ برنده جایزه نوبل..','../images/Papers/20-1.jpg','2018-08-09 22:40:55', '2018-08-09 22:40:55','0','namemansorkh','!');
UPDATE Paper
SET dastebandi = 1
WHERE dastebandi = '!';

DROP table category;
CREATE TABLE category(ID int NOT NULL AUTO_INCREMENT,
                  name VARCHAR(300) CHARACTER SET utf8 COLLATE utf8_general_ci,
  PRIMARY KEY (ID)) DEFAULT CHARSET=utf8;

INSERT INTO category(name) VALUES ('طب سنتی');
INSERT INTO category(name) VALUES ('مراقبت‌های پوست');
INSERT INTO category(name) VALUES ('روش‌های درمانی');
INSERT INTO category(name) VALUES ('تجهیزات تخصصی پوست، مو و زیبایی اندام');



DROP table slider;
CREATE TABLE slider(ID int NOT NULL AUTO_INCREMENT,
                  headerName VARCHAR(300) CHARACTER SET utf8 COLLATE utf8_general_ci  DEFAULT "",
                  Mokhtasar VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci  DEFAULT "",
                  image VARCHAR(1000),
                  link VARCHAR(300) DEFAULT "",
                  alt  VARCHAR(300) DEFAULT "",
  PRIMARY KEY (ID)) DEFAULT CHARSET=utf8;

INSERT INTO slider(headerName,Mokhtasar,image) VALUES
                  ('Los Angeles' , 'LA is always so much fun!' , 'images/slider/skincare.jpg');
INSERT INTO slider(image) VALUES
                  ('images/slider/shutterstock_61969534.jpg');
INSERT INTO slider(image) VALUES
                  ('images/slider/laser-face-rejuvenation.jpg');
-- create DATABASE wikiderm;
use wikiderm;


DROP table Paper;
CREATE TABLE Paper(ID int NOT NULL AUTO_INCREMENT,
                  XMLNAME VARCHAR(300),
                  name VARCHAR(300) CHARACTER SET utf8 COLLATE utf8_general_ci,
                  Mokhtasar VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci,
                  image VARCHAR(1000),
                  time TIMESTAMP,
                  realtime VARCHAR(200),
                  mahbobiat int DEFAULT 0,
                  post_name VARCHAR(300) DEFAULT "",
                  dastebandi VARCHAR(300),
                  writerID VARCHAR(100),
                  stat int DEFAULT 0,
  FOREIGN KEY (writerID) REFERENCES users(mobile),
  PRIMARY KEY (ID)) DEFAULT CHARSET=utf8;


DROP table userEshterak;
CREATE TABLE userEshterak(ID int NOT NULL AUTO_INCREMENT,
                  name VARCHAR(300) CHARACTER SET utf8 COLLATE utf8_general_ci,
                  image VARCHAR(1000),
                  tozihat VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci,
  PRIMARY KEY (ID)) DEFAULT CHARSET=utf8;

  INSERT INTO userEshterak(name) VALUES
                  ('یک ماهه');

  INSERT INTO userEshterak(name) VALUES
                  ('سه ماهه');

  INSERT INTO userEshterak(name) VALUES
                  ('یک ساله');
drop TABLE users;
CREATE TABLE users(ID int NOT NULL AUTO_INCREMENT,
                  mobile VARCHAR(100) UNIQUE ,
                  name VARCHAR(300) CHARACTER SET utf8 COLLATE utf8_general_ci,
                  address VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci,
                  image VARCHAR(1000),
                  email VARCHAR(300),
                  categoryID int DEFAULT 0,
                  eshterakID int DEFAULT 0,
                  realtime VARCHAR(200),
                  pass VARCHAR(100),
                  verified int,
                  verificationcode VARCHAR(100),
                  codetime TIMESTAMP,
                  attempt int,
                  attemptgetpassword int DEFAULT 1,
                  passwordtime int,
                  stat int DEFAULT 0,
                  typ int DEFAULT 0,
  FOREIGN KEY (categoryID) REFERENCES userCategory(ID),
  FOREIGN KEY (eshterakID) REFERENCES userEshterak(ID),
  PRIMARY KEY (ID)) DEFAULT CHARSET=utf8;

  CREATE TABLE token(ID INT NOT NULL AUTO_INCREMENT,
      token VARCHAR(100),
      token2 VARCHAR(100),
      PRIMARY KEY (ID));





INSERT INTO Paper(XMLNAME, name,writerID, Mokhtasar, image, time, realtime, mahbobiat, post_name, dastebandi) VALUES
  ('../XMLs/PaperXMLs/5b6d405a9a1fd5b6d405a9a222.xml','نام مقاله','09196487205','نام من سرخ (به ترکی استانبولی: Benim Adım Kırmızı) رمانی از اورهان پاموک است تحت تأثیر رمان مشهور ایتالیایی نام گل سرخ. نام من سرخ برنده جایزه نوبل..','../images/Papers/20-1.jpg','2018-08-09 22:40:55', '2018-08-09 22:40:55','0','namemansorkh','1');


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

DROP TABLE user_request;
CREATE TABLE user_request(
  ID int NOT NULL AUTO_INCREMENT,
  name VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci,
  subject VARCHAR(300) CHARACTER SET utf8 COLLATE utf8_general_ci,
  message VARCHAR(2000) CHARACTER SET utf8 COLLATE utf8_general_ci,
  email VARCHAR(100),
  status int default 0,
  PRIMARY KEY (ID)) DEFAULT CHARSET=utf8;


DROP TABLE menue;
CREATE TABLE menue(
  ID int NOT NULL AUTO_INCREMENT,
  name VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci,
  link VARCHAR(100),
  active int default 0,
  PRIMARY KEY (ID)) DEFAULT CHARSET=utf8;

INSERT INTO menue(name,link) VALUES
                  ('صفحه اصلی','/');
INSERT INTO menue(name,link) VALUES
                  ('مقالات','maghalat.php');
INSERT INTO menue(name,link) VALUES
                  ('سلویک','http://cellwik.ir/');
INSERT INTO menue(name,link) VALUES
                  ('تماس با ما','contactUs.php');
INSERT INTO menue(name,link) VALUES
                  ('درباره ما','aboutUs.php');
INSERT INTO menue(name,link) VALUES
                  ('آگهی','');

DROP table userCategory;
CREATE TABLE userCategory(ID int NOT NULL AUTO_INCREMENT,
                  name VARCHAR(300) CHARACTER SET utf8 COLLATE utf8_general_ci,
  PRIMARY KEY (ID)) DEFAULT CHARSET=utf8;

INSERT INTO userCategory(name) VALUES ('دارویی');
INSERT INTO userCategory(name) VALUES ('درمانی');
INSERT INTO userCategory(name) VALUES ('آرایشی');
INSERT INTO userCategory(name) VALUES ('تجاری');


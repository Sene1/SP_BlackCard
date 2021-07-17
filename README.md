# 신평고 블랙카드 제도 (SP_BlackCard)
###### 신평고 급식제도에서 사용되는 블랙카드 제도 입니다
###### 의존성: [school-meal-api - 전국 급식 API](https://github.com/Jrady721/school-meal-api)
###### Maria DB, HTML, PHP, Javascript, CSS etc
###### Issue와 Pull Request는 환영입니다!
## 데이터베이스 (website)
###### 아래는 테이블 구조
### member
id  | user_id | pw | name | verify | hakbun | regdate
------------- | ------------- | -------------| ------------- | ------------- | -------------| ------------- | 
 INT(11) | VARCHAR(150)| VARCHAR(255) | VARCHAR(10) | INT(11) | INT(11) | DATETIME() 
 

------------


 ### logs
id  | to | from | kind | amount | back | after | datetime
------------- | ------------- | -------------| ------------- | ------------- | -------------| ------------- | ------------- | 
 INT(11) | VARCHAR(50)| VARCHAR(50) | VARCHAR(50) | INT(11) | INT(11) | INT(11) | DATETIME()
 

------------


 ### logs_reg
id  | to | to_email | from | kind | datetime
------------- | ------------- | -------------| ------------- | ------------- | ------------- |
 INT(11) | VARCHAR(50)| VARCHAR(50) | VARCHAR(50) | VARCHAR(50) | DATETIME() 
 

------------


 ### register
id  | barcode | hakbun | grade | class | num | name | card
------------- | ------------- | -------------| ------------- | ------------- | -------------| ------------- | ------------- | 
 INT(10) | VARCHAR(15) | INT(4)  | INT(1) | INT(1) | INT(2) | VARCHAR(10) | INT(11)
 

------------


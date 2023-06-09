-- 의사 릴레이션
CREATE TABLE DOCTOR (
	DOCTORID CHAR(10) NOT NULL, -- 의사ID
	MS CHAR(10), -- 담당진료과목 
    POSITION CHAR(10), -- 직급 
    DOCNAME CHAR(10), -- 이름
	GENDER CHAR(10), -- 성별
    TEL CHAR(15), -- 전화번호
    EMAIL CHAR(30), -- 이메일
    PRIMARY KEY(DOCTORID)
    );
    
-- 간호사 릴레이션
CREATE TABLE NURSE (
	NURSEID CHAR(10) NOT NULL, -- 간호사ID
	MS CHAR(10), -- 담당진료과목
    POSITION CHAR(10), -- 직급 
    NURNAME CHAR(10),
	GENDER CHAR(10),
    TEL CHAR(15),
    EMAIL CHAR(30),
    PRIMARY KEY(NURSEID)
    );

-- 환자 릴레이션
CREATE TABLE PATIENT (
	PATIENTID CHAR(10) NOT NULL, -- 환자ID
    JOB CHAR(10), -- 직업
    PATIENTNAME CHAR(10),
	GENDER CHAR(10),
    TEL CHAR(15),
    EMAIL CHAR(40),
    ADDRESS CHAR(50),
    RRN CHAR(15), -- 주민번호
    DOCTORID CHAR(10), -- 담당의사
    NURSEID CHAR(10), -- 담당간호사
    PRIMARY KEY(PATIENTID),
    FOREIGN KEY(DOCTORID) references DOCTOR(DOCTORID),
	FOREIGN KEY(NURSEID) references NURSE(NURSEID)
    );
    
-- 진료 릴레이션
CREATE TABLE DIAGNOSIS (
	DIAID INT NOT NULL, -- 진료ID
	DOCTORID CHAR(10), -- 의사ID
    PATIENTID CHAR(10), -- 환자ID
    CONTENT CHAR(30), -- 진료내용
    DIADATE CHAR(15), -- 진료날짜
    PRIMARY KEY(DIAID),
    foreign key(DOCTORID) references DOCTOR(DOCTORID),
    foreign key(PATIENTID) references PATIENT(PATIENTID)
    );
  
-- 차트 릴레이션
CREATE TABLE CHART(           
  CHARTID INT NOT NULL,
  DIAID INT NOT NULL,
  DOCTORID CHAR(10), -- 담당의사ID 
  NURSEID CHAR(10), -- 간호사ID
  PATIENTID CHAR(10),
  DOCOPINION CHAR(30), -- 의사소견
  PRIMARY KEY(CHARTID),
  FOREIGN KEY (DIAID) REFERENCES DIAGNOSIS(DIAID),
  FOREIGN KEY (DOCTORID) REFERENCES DOCTOR(DOCTORID),
  FOREIGN KEY (NURSEID) REFERENCES NURSE(NURSEID),
  FOREIGN KEY (PATIENTID) REFERENCES PATIENT(PATIENTID)
);

-- 진료내용 인덱스
CREATE INDEX CONTENT_INDEX ON DIAGNOSIS(CONTENT);
SHOW INDEX FROM DIAGNOSIS;

-- 의사소견 인덱스
CREATE INDEX INDEX_OPINION ON CHART(DOCOPINION);
SHOW INDEX FROM CHART;

-- 환자이름 인덱스
CREATE INDEX INDEX_PATIENT ON PATIENT(PATIENTNAME);
SHOW INDEX FROM PATIENT;
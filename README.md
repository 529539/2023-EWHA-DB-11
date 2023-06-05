# 2023-EWHA-DB-11

### 📑 [보고서 노션 페이지](https://529539.notion.site/40cb7f851fbe4acebde4421f6dce568c)

## 웹 화면 캡쳐

- **전체 동작 GIF**
    
    ![2023DB02_11](https://github.com/529539/2023-EWHA-DB-11/assets/102040717/8f9b6aa2-fb66-4875-92e1-caf95665d032)
    
    - 데모 시연 영상
        
        [23-1 데이터베이스 2분반 11조 웹 구현 시연](https://youtu.be/T5f9OYlKA0k)
        

- **환자 이름으로 조회 - 검색 전 전체 목록**
    
    ![localhost_project_php_search php](https://github.com/529539/2023-EWHA-DB-11/assets/102040717/8f9bf816-707b-4f2f-bf91-8a0c3ca11dd0)

- **환자 이름으로 조회 - 검색 후 결과**
    
    ![localhost_project_php_result php_name=%EA%B9%80%EC%9D%B4%ED%99%94 (1)](https://github.com/529539/2023-EWHA-DB-11/assets/102040717/ad09a790-b8c7-4507-bd11-e04ffa30a627)

- **분석 보고서 - 연령대별 방문 진료과 통계**

    <img width="1218" alt="스크린샷 2023-06-05 오후 3 58 27" src="https://github.com/529539/2023-EWHA-DB-11/assets/102040717/9a747cc5-51cf-4d27-83bb-dd08e5f05513">

## 프로그램

```
Application/XAMPP/xamppfiles/htdocs 폴더 하위에 project 폴더 생성
```

```
📂 project
├─ 📂 php  ▶️ DB에서 데이터를 가져와서 HTML로 화면에 렌더하는 PHP 파일
├─ 📂 sql  ▶️ 데이터베이스 구축 시 사용한 쿼리문
├─ 📂 style  ▶️ CSS 파일
└─ index.html ▶️ 첫 랜딩 페이지
```

### php에서 사용한 쿼리문

```sql
-- 환자의 모든 정보, 담당 의사/간호사의 이름 (담당 의사/간호사 ID로 해당하는 의사/간호사의 이름을 조인)
SELECT P.*, D.DOCNAME, N.NURNAME
FROM PATIENT AS P
JOIN DOCTOR AS D ON P.DOCTORID = D.DOCTORID
JOIN NURSE AS N ON P.NURSEID = N.NURSEID;

-- 등록된 전체 환자 수
SELECT COUNT(*) AS tuple_count FROM PATIENT;
```

```sql
-- input 태그로 검색한 name과 이름이 일치하는 환자의 모든 정보, 담당 의사/간호사의 정보
SELECT * FROM PATIENT AS P
JOIN DOCTOR AS D ON P.DOCTORID = D.DOCTORID
JOIN NURSE AS N ON P.NURSEID = N.NURSEID
WHERE PATIENTNAME = '$name';

-- name과 이름이 일치하는 환자의 ID로 기록된 차트의 모든 정보, 차트의 진료 ID와 일치하는 진료의 정보
SELECT * FROM CHART AS C
JOIN DIAGNOSIS AS DI ON C.DIAID = DI.DIAID
JOIN PATIENT AS P ON C.PATIENTID = P.PATIENTID
JOIN DOCTOR AS D ON C.DOCTORID = D.DOCTORID
JOIN NURSE AS N ON C.NURSEID = N.NURSEID
WHERE P.PATIENTNAME = '$name';
```

```sql
-- 10대(=주민등록번호가 05~14로 시작하는) 환자의 정보, 진료과, 진료 내용, 차트 ID
SELECT P.*, D.MS, DI.CONTENT, C.CHARTID FROM CHART AS C
JOIN PATIENT AS P ON C.PATIENTID = P.PATIENTID
JOIN DIAGNOSIS AS DI ON C.DIAID = DI.DIAID
JOIN DOCTOR AS D ON C.DOCTORID = D.DOCTORID
WHERE SUBSTRING(P.RRN, 1, 2) BETWEEN '05' AND '14';

-- 10대 환자의 모든 차트 수 (10대 환자 방문 횟수)
SELECT COUNT(*) AS tuple_count FROM CHART AS C
JOIN PATIENT AS P ON C.PATIENTID = P.PATIENTID
JOIN DIAGNOSIS AS DI ON C.DIAID = DI.DIAID
JOIN DOCTOR AS D ON C.DOCTORID = D.DOCTORID
WHERE (D.MS = '내과' OR D.MS = '정형외과' OR D.MS = '소아과' OR D.MS = '피부과')
AND SUBSTRING(RRN, 1, 2) BETWEEN '05' AND '14';

-- 10대 환자 중 진료과가 '내과'인 차트의 수 (10대 환자 중 내과 방문 횟수)
SELECT COUNT(*) AS tuple_count FROM CHART AS C
JOIN PATIENT AS P ON C.PATIENTID = P.PATIENTID
JOIN DIAGNOSIS AS DI ON C.DIAID = DI.DIAID
JOIN DOCTOR AS D ON C.DOCTORID = D.DOCTORID
WHERE D.MS='내과' AND SUBSTRING(P.RRN, 1, 2) BETWEEN '05' AND '14';
```

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php echo $_GET['name']; ?> 검색 결과</title>
        <link rel="stylesheet" href="../style/result.css">
    </head>
    <body>
        <?php
            $conn = mysqli_connect("localhost", "root", "", "hospital");
            if (!$conn) {
                echo "DATA BASE CONNECTION ERROR!";
            } else {
                if (mysqli_connect_errno()) {
                echo "Could not connect: " . mysqli_connect_error();
                exit();
                }
            $name = $_GET['name'];
            $query1 = 
            "SELECT * FROM PATIENT AS P
            JOIN DOCTOR AS D ON P.DOCTORID = D.DOCTORID
            JOIN NURSE AS N ON P.NURSEID = N.NURSEID
            WHERE PATIENTNAME = '$name'";
            $result1 = mysqli_query($conn, $query1);
            $result2 = mysqli_query($conn, $query1);
            $query2 = 
            "SELECT * FROM CHART AS C
			JOIN DIAGNOSIS AS DI ON C.DIAID = DI.DIAID
			JOIN PATIENT AS P ON C.PATIENTID = P.PATIENTID
            JOIN DOCTOR AS D ON C.DOCTORID = D.DOCTORID
            JOIN NURSE AS N ON C.NURSEID = N.NURSEID
            WHERE P.PATIENTNAME = '$name'";
		$result3 = mysqli_query($conn, $query2);
		$result4 = mysqli_query($conn, $query2);
            }
        ?>
        <header>
            <div class="title-text">23-1 데이터베이스 2분반 11조 팀 프로젝트</div>
        </header>
        <main>
            <nav>
                <div class="link-div">
                    <a href="search.php" class='now'>환자 이름으로 조회</a>
                </div>
                <div class="border"></div>
                <div class="link-div"><a href="report.php">분석 보고서</a></div>
            </nav>
            <form method="get" action="result.php">
                <div class="input-title">환자 정보 조회</div>
                <input class="input" type="text" name="name" placeholder="이름을 입력하세요" autocomplete='off' value=<?php echo $_GET['name']; ?> />
                <input class="button" type="submit" value="검색"/>
            </form>
            <div class='table-title'>'<?=$name?>' 검색 결과</div>
            <?php
				if (!mysqli_fetch_array($result1)) {
					echo '<div class="no-title">검색 결과 없음</div>';
				}
			?>
            <?php while($row = mysqli_fetch_array($result2)) {?>
			<section class="table-container">
				<div class="table-subtitle">환자 정보</div>
				<table>
					<tr>
						<th>이름</th>
                        <td><?=$name?></td>
						<th>환자 ID</th>
						<td><?=$row['PATIENTID']?></td>
					</tr>
					<tr>
                        <th>담당 의사 (ID)</th>
                        <td><?=$row['DOCNAME']?>  (<?=$row['DOCTORID']?>)</td>
                        <th>담당 간호사 (ID)</th>
                        <td><?=$row['NURNAME']?>  (<?=$row['NURSEID']?>)</td>
                    </tr>
					<tr>
                        <th>성별</th>
						<td><?=$row['GENDER']?></td>
						<th>주민번호</th>
						<td><?=$row['RRN']?></td>
					</tr>
					<tr>
						<th>전화번호</th>
						<td><?=$row['TEL']?></td>
						<th>이메일</th>
						<td><?=$row['EMAIL']?></td>
					</tr>
					<tr>
						<th>직업</th>
						<td><?=$row['JOB']?></td>
						<th>주소</th>
						<td><?=$row['ADDRESS']?></td>
				</tr>
				</table>
			<?php } ?>
            <?php
				if (mysqli_fetch_array($result3)) {
					echo '<hr /> <div class="table-subtitle">진료 기록</div>';
				}
			?>
			<?php while($row = mysqli_fetch_array($result4)) {?>
                <div>
                    <div class='chart-date'><?=$row['DIADATE']?> (진료 ID : <?=$row['DIAID']?>)</div>
                    <table>
                        <tr>
                            <th>담당 의사 (ID)</th>
                            <td><?=$row['DOCNAME']?>  (<?=$row['DOCTORID']?>)</td>
                        </tr>
                        <tr>
                            <th>담당 간호사 (ID)</th>
                            <td><?=$row['NURNAME']?>  (<?=$row['NURSEID']?>)</td>
                        </tr>
                        <tr>
                            <th>진료 내용</th>
                            <td><?=$row['CONTENT']?></td>
                        </tr>
                        <tr>
                            <th>의사 소견</th>
                            <td><?=$row['DOCOPINION']?></td>
                        </tr>
                    </table>
                    <br />
                </div>
			<?php } ?>
            </section>
        </main>
    </body>
</html>
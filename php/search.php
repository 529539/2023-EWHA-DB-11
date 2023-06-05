<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>환자 이름으로 조회</title>
    <link rel="stylesheet" href="../style/search.css">
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
        $query = "SELECT P.*, D.DOCNAME, N.NURNAME
        FROM PATIENT AS P
        JOIN DOCTOR AS D ON P.DOCTORID = D.DOCTORID
        JOIN NURSE AS N ON P.NURSEID = N.NURSEID";
        $result = mysqli_query($conn, $query);

        $query2 = "SELECT COUNT(*) AS tuple_count FROM PATIENT";
        $result2 = $conn->query($query2);
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
          <input class="input" type="text" name="name" placeholder="이름을 입력하세요" autocomplete='off' />
          <input class="button" type="submit" value="검색"/>
        </form>
        <div class='table-title'>
          전체 환자 목록
          <?php
          if ($result2->num_rows > 0) {
            $row = $result2->fetch_assoc();
            $tupleCount = $row["tuple_count"];
            echo "(" . $tupleCount . "건)";
          }
          ?>
        </div>
        <table>
          <thead>
            <td>환자 번호</td>
            <td>환자 이름</td>
            <td>성별</td>
            <td>직업</td>
            <td>전화번호</td>
            <td>이메일</td>
            <td>주소</td>
            <td>주민등록번호</td>
            <td>담당 의사</td>
            <td>담당 간호사</td>
          </thead>
          <?php
            while ($row = mysqli_fetch_array($result)) {
              echo "<tr>";
              echo "<td>" . $row['PATIENTID'] . "</td>";
              echo "<td>" . $row['PATIENTNAME'] . "</td>";
              echo "<td>" . $row['GENDER'] . "</td>";
              echo "<td>" . $row['JOB'] . "</td>";
              echo "<td>" . $row['TEL'] . "</td>";
              echo "<td>" . $row['EMAIL'] . "</td>";
              echo "<td>" . $row['ADDRESS'] . "</td>";
              echo "<td>" . $row['RRN'] . "</td>";
              echo "<td>" . $row['DOCNAME'] . "</td>";
              echo "<td>" . $row['NURNAME'] . "</td>";
              echo "</tr>";
            }
          ?>
        </table>
      </main>
    <?php
    mysqli_free_result($result);
    mysqli_close($conn);
    ?>
  </body>
</html>
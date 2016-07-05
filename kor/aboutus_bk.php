<?php 
$page_title = "투산 한인 테니스 협회 - 소개"; 
$file_name = "aboutus.php";
?>
<!DOCTYPE html
  PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html40/strict.dtd">
<html>
<head>
<?php include('header.php'); ?>
</head>
<body id="main_body">
   <div id="container">
   <div id="header">
   <?php include('language_choice.php'); ?>
   <div id="key_visual">
   <?php include('logo.php'); ?>
   </div>
   </div>
   <div id="main_container">
   <table>
       <tr>
       <td colspan="1" id="sub_nav_column" rowspan="1">
       <div id="left_column_container">
       <div id="main_nav_container">
       <?php include('navigation.php'); ?>
       </div>
       <div id="sub_container1"></div>
       </div>
       </td>
       <td colspan="1" id="content_column" rowspan="1">
       <div id="sub_container2">
       <div class="content" id="content_container">
       <h3>협회 소개</h3>
       <p>
       <a href="members.php"><span class="subtitle_black">회원</span></a><br />
       회원이 되기 위해 필요한 형식적인 절차는 없습니다.  누구든지 와서 같이 테니스를 치게 되면 그 때부터 회원으로 간주됩니다.  회원 가입도 자유롭게 할 수 있지만, 또한 탈퇴도 자유입니다.  그냥 나오지 않으면 그만입니다.  가끔 특별 행사나 중요한 공지 사항이 있을 때 매달 한번씩 이메일을 받게 되는데, 원하지 않으시면 <a href="mailto:contact@koreantennis.org">contact@koreantennis.org</a>로 이메일을 보내어 메일 리스트에서 이름을 제거하시면 됩니다.  자세한 회원 분포를 확인하시려면 <a href="members.php">여기</a>를 클릭하세요.
       </p>
       <div class="subtitle_black">회비</div>
       매달 <span class="text_red">$10</span>의 회비가 있습니다.  회비는 강제성이 없이 그냥 자발적으로 납부해 주시면 됩니다.  매달 아무때나 테니스 치러 나오실 때 총무에게 내어주시면 됩니다.  회비는 코트 사용료, 테니스 공과 그 밖의 필요한 물품 구입, 그리고 회비 잔고가 많을 때는 회식 등의 용도로 사용합니다.
</p>
       <p>
       <a href="timelocation.php"><span class="subtitle_black">시간</span></a><br />
       월 7:30 pm - 10:00 pm <br /> 
       금 7:30 pm - 10:00 pm <br />
       </p>
       
       <p>
       <a href="timelocation.php"><span class="subtitle_black">장소</span></a><br />
       Fort Lowell Park Tennis Center<br />
       2900 North Craycroft Road (NE corner of Craycroft & Glenn)<br />
	   Tucson, AZ 85712<br />
	   (520) 235-3986
       </p>
       시간과 장소에 대한 더 자세한 정보는 <a href="timelocation.php">여기</a>를 클릭하세요.
       </div>
       </div>
       </td>
       </tr>
   </table>
   </div>
   <div id="content_b"></div>
   <?php include('footer.php'); ?>
   </div>
</body>
</html>
<?php 
$page_title = "투산 한인 테니스 협회 랭킹제"; 
$file_name = "ranking_system.php";
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
       <h3>투산 한인 테니스 협회 랭킹제</h3>
       <p>
       <div class="subtitle_black">랭킹제를 도입하며</div>
       랭킹제를 도입하는 목적은 회원들의 테니스 실력을 좀 더 향상시키고, 다른 회원과의 원활한 교류를 위해서입니다.  이전까지 우리는 주로 복식 경기 위주로 모임을 가져 왔는데, 실제 경기의 긴장감을 유지한 채 경기를 진행할 수 있는 단식 경기도 또한 중요하다고 생각합니다.  랭킹제를 진행함으로써 모든 공식적인 단식 경기 결과를 데이터베이스에 저장하고 확인할 수 있기 때문에, 회원들이 더욱 테니스 실력을 연마하고 노력하는 자극제가 되었으면 합니다.
       </p>
       <p>
       <div class="subtitle_black">진행 방법</div>
       랭킹제 진행 방법은 다음과 같습니다.
       <ul>
       	<li class="contenttitle_green">단식 경기 진행</li>
           <ul>
           <li>매달 첫번째 월요일과 금요일에는 될 수 있으면 같은 조의 다른 회원과 단식 경기를 진행합니다.</li>
           <li>두 회원의 합의 아래 언제든지 어디서든지 랭킹제 공식 경기를 진행할 수 있습니다.</li>
           <li>경기 규칙, 예를 들어 한 세트에 몇 게임을 할 것인지 등은 전적으로 두 사람의 합의에 따릅니다.</li>
           <li><a href="member_list.php">Member List</a>에서 같은 조에 속하는 다른 사람이 누군지 확인하세요.</li>
           </ul>
		<li class="contenttitle_green">기록</li>
        	<ul>
            <li>모든 공식적인 단식 경기의 결과를 기록자에게 알려 줍니다.</li>
            <li>기록자가 근처에 없거나, 다른 장소에서 경기를 진행했을 경우, 경기 결과를 <a href="mailto:contact@koreantennis.org">contact@koreantennis.org</a>에 이메일로 보내 주세요.</li>
            </ul>
        <li class="contenttitle_green">웹사이트 확인</li>
        	<ul>
            <li><a href="rankings.php">Ranking List</a> - 랭킹 순서에 따라 승패 전적, 승률, 점수 등을 표시해 줍니다. </li>
            <li><a href="games.php">Game List</a> - 경기 결과를 리스트로 보여 줍니다.</li>
            <li><a href="ranking_system_rules.php">Ranking System Rules</a> - 랭킹제의 자세한 규칙을 확인하세요.</li>
            </ul>
       </ul>           
       </p>
       <p>
       <div class="subtitle_orange">랭킹제 진행은 강제성이 없습니다!</div>
       <span class="text_red">랭킹제 참가 여부는 전적으로 본인의 의사에 따릅니다.</span>  랭킹제에 참가하지 않아도 언제든지 와서 같이 테니스 치시면 항상 환영합니다.    
       </p>
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
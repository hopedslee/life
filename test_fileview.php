<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>a태그 form 전송</title>
    <script>
      // content, cate, index를 인수로 받아 form 태그로 전송하는 함수
      function goFileview(filename) {
        // name이 paging인 태그
        var f = document.paging;
        // form 태그의 하위 태그 값 매개 변수로 대입
        f.filename.value = filename;
        // input태그의 값들을 전송하는 주소
        f.action = "fileview.php"
        // 전송 방식 : post
        f.method = "post"
        f.submit();
      };
    </script>
  </head>
  <body>
    <!-- 페이지 전송 폼 -->
    <form name="paging">
    	<input type="hidden" name="filename"/>
    </form>
    <!-- a태그로 인수 전달 -->
    <a href="javascript:goFileview('에이에프피식물병원_주주참여동의서.jpg');">View</a>
	<!-- <a href="javascript:goFileview('aaa.txt');">View</a> -->
  </body>
</html>
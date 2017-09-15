<?php require_once 'inc/head.php'; ?>
<?php require_once 'inc/header.php'; ?>

<?php
	if(!isset($_GET["msv"])) echo "Mời bạn nhập mã sinh viên vào";
	if( isset( $_GET["msv"] )  && !is_numeric( $_GET["msv"] )  ) die( "Mày nhập hẳn hoi :| " );

	//cho thu vien vao 
	require_once 'inc/simplehtmldom_1_5/simple_html_dom.php';
	
	// link chinh
	$baseUrl= "http://daotao.uneti.edu.vn";

	// url: link lay msv
	$url= "http://daotao.uneti.edu.vn/XemDiem.aspx?MSSV=" ;


	// msv
	$msv= trim($_GET["msv"]);



	// khai bao curl_init
	$curl= curl_init($url . $msv);

	// set up curl
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);


	// thuc thi curl
	$resource= curl_exec($curl); //thuc thi trong dieu kien dep

	if(!$resource) die("có vẻ như đang mất mạng"); 

	$html= new simple_html_dom();


	// lay thong tin, load thong tin 
	$html->load($resource);

	// kiem tra xem co ton tai hay k
	//
	//check neu tra ve ko  ton tai 

	// $ifExists = $html->find("center");

	// if($ifExists->innertext == "MSSV không hợp lệ" )
	// 		die("MSV ko ton tai :(( "); 

	// lay thong tin
	//tim hinh anh
	$avatar= $html->find("img.hinh-sinhvien");

	// echo "<img src='" . $baseUrl . "/" . $avatar[0]->src . "' /> <br/>"; 

	$ten= $html->find("div.title-group");

	// echo "<h1>"   . explode("<br />" , $ten[0]->innertext )[1] .  "</h1>" ;

	$thongtinsinhvien= $html->find("table.none-grid");

	// echo "<h1>" .$thongtinsinhvien[0]. "</h1>";



	// echo "<h1>" .$thongtinsinhvien[1]. "</h1>";

	$bangdiem = $html->find("table.tblKetQuaHocTap");

		// echo
		// 	"<table class='table-bang-diem-1'>".

		// 		 $bangdiem[0]->innertext 

		// 	 .'</table>';




		// echo
		// 	"<table class='table-bang-diem-1'>".

		// 		 $bangdiem[1]->innertext 

		// 	 .'</table>';

			

	
?>
<div class="xemdiem-sinhvien">
	<div class="xemdiem-sinhvien-header">
		<h1> BẢNG KẾT QUẢ HỌC TẬP </h1>
		
			<?php echo "<p>". "Họ và tên:"  . explode("<br />" , $ten[0]->innertext )[1] .  "</p>" ; ?> 
	
	</div> <!-- .xemdiem-sinhvien-header -->
	
	<div class="layout-1">
		<div class="hinh-sinhvien">
			<?php echo "<img src='" . $baseUrl . "/" . $avatar[0]->src . "' /> <br/>"; ?> 
		</div> <!-- .hình-sinhvien -->
	 		
	 	<div class="thongtin-sinhvien">
			<?php echo "<p>" .$thongtinsinhvien[0]. "</p>"; ?>
		</div>
	</div> <!-- .layout-1 -->

	<div class="layout-2">
		<div class="layout-2-thongtinhoctap">
			<h1> THÔNG TIN HỌC TẬP </h1>
		</div>

		<div class="layout-2-table">
			<?php echo "<p>" .$thongtinsinhvien[1]. "</p>"; ?>
		</div>
	</div> <!-- .layout-2 -->

	<div  class="layout-3">
		<?php 
			echo
				"<table class='table-bang-diem-1'>".
						 $bangdiem[0]->innertext 

				 .'</table>';
		?>
	</div><!--  layout-3 -->

	<div  class="layout-4">
		<?php 
			echo
				"<table class='table-bang-diem-2'>".
						 $bangdiem[1]->innertext 

				 .'</table>';
		?>
	</div><!--  layout-4 -->
	<div class="layout-5">
		<p style="color:Red;font-weight:bold;padding:10px;line-height:17px;"> Lưu ý: Nếu sinh viên đã đóng học phí nhưng bị ghi chú là Cấm thi vì nợ học phí hoặc Chưa đóng học phí thì liên hệ với khoa và yêu cầu được xét lại dự thi </p>
	</div> <!-- .layout-5 -->
</div>
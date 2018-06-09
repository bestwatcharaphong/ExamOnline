/* กำหนดว่าให้ element ต่างๆ ถูก load มาพร้อมใช้งานเสียก่อน คำสั่งจึงจะทำงาน */
$(document).ready(function(){

	/* เพิ่มส่วนนี้เข้าไปจะถือว่าเป็นการตั้งค่าให้ Datatable เป็น Default ใหม่เลย */
	$.extend(true, $.fn.dataTable.defaults, {
	    "language": {
	              "sProcessing": "กำลังดำเนินการ...",
	              "sLengthMenu": "แสดง_MENU_ แถว",
	              "sZeroRecords": "ไม่พบข้อมูล",
	              "sInfo": "",													//แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว
	              "sInfoEmpty": "",												//แสดง 0 ถึง 0 จาก 0 แถว
	              "sInfoFiltered": "",											//(กรองข้อมูล _MAX_ ทุกแถว)
	              "sInfoPostFix": "",
	              "sSearch": "ค้นหา:",
	              "sUrl": "",
	              "oPaginate": {
	                            "sFirst": "เริ่มต้น",
	                            "sPrevious": "ก่อนหน้า",
	                            "sNext": "ถัดไป",
	                            "sLast": "สุดท้าย"
	              }
	     }
	});

	$('.datatable').DataTable({
		aLengthMenu: [
	        [20, 50, 100, 200, -1],
	        [20, 50, 100, 200, "All"]
	    ]
	});

	/*---------------------------------------------1---------------------------------------------------*/

	/*ajax fill form add exam*/
	$('#subject_id').on('change', function(){
		var subject_id = $(this).val();
		if(subject_id){
			$.ajax({
				type: 'POST',
				url: '../ajax/ajax_exam.php',				/* page ปลายทางด้าน server ที่จะเชื่อมต่อ */
				data: 'subject_id=' + subject_id,	/* ข้อมูลที่จะส่งไปยัง page ปลายทาง */
				success: function(html){			/* function ที่จะถูกเรียกขึ้นมาทำงาน ถ้าผลลัพธ์ถูกส่งกลับมาได้สำเร็จ */
					$('#set').html(html);
					$('.question_order').html("");
				}
			});
		}else{
			$('#set').html('<option value="">เลือกวิชาก่อน</option>');
		}
	});

	/*-------------------------------------------2-----------------------------------------------------*/

	/*ajax fill form add exam ข้อที่ */
	$('#set').on('change', function(){
		var set_id = $(this).val();
		if(set_id){
			$.ajax({
				type: 'post',
				url: '../ajax/ajax_exam.php',					/*server*/
				data: 'set_id=' + set_id,
				success: function(result){
					$('.question_order').html(result);
				}
			});

			$.ajax({
				type: 'post',
				url: '../ajax/ajax_amount_choice1.php',					/*server*/
				data: 'set_id=' + set_id,
				success: function(result){
					$('#amount_choice').html(result);
				}
			});

			$.ajax({
				type: 'post',
				url: '../ajax/ajax_choice5_div.php',					/*server*/
				data: 'set_id=' + set_id,
				success: function(result){
					$('#choice5_div').html(result);
				}
			});
		}
	});

	/*-----------------------------------------3-------------------------------------------------------*/

	/*ajax fill form add exam amount choice*/
	$('#amount_choice').on('change', function(){
		var amount_choice = $(this).val();
		var set_id = $('#set').val();
		if(amount_choice && set_id){
			$.ajax({
				type: 'POST',
				url: '../ajax/ajax_amount_choice2.php',
				data: 'amount_choice=' + amount_choice + '&set_id=' + set_id,
				success: function(html){
					$('#choice5_div').html(html);
				}
			});
		}

		if(amount_choice && set_id==''){
			$.ajax({
				type: 'POST',
				url: '../ajax/ajax_amount_choice2.php',
				data: 'amount_choice=' + amount_choice,
				success: function(html){
					$('#choice5_div').html(html);
				}
			});
		}
	});

	/*-----------------------------------4 Toggle activeflag exam---------------------------------*/
	$(".activeflag").change(function() {
		var activeflag = 0;
		var set_activeflag_id = $(this).attr('data-id');

	    if(this.checked) {
	        activeflag = 1;
	    }else{
			activeflag = 0;
		}

		$.ajax({
			type: 'POST',
			url: '../ajax/ajax_activeflag.php',
			data: 'activeflag=' + activeflag + '&set_activeflag_id=' + set_activeflag_id
		});
	});



});			/*End document.ready() */

/*------------------------------------------------------------------------------------------------*/

/*Menu-toggle*/
$(window).resize(function() {
	var path = $(this);
	var contW = path.width();
	if(contW >= 751){
		document.getElementsByClassName("sidebar-toggle")[0].style.left="200px";
	}else{
		document.getElementsByClassName("sidebar-toggle")[0].style.left="-200px";
	}
});

$(document).ready(function() {
	$('.dropdown').on('show.bs.dropdown', function(e){
		$(this).find('.dropdown-menu').first().stop(true, true).slideDown(300);
	});
	$('.dropdown').on('hide.bs.dropdown', function(e){
		$(this).find('.dropdown-menu').first().stop(true, true).slideUp(300);
	});
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		var elem = document.getElementById("sidebar-wrapper");
		left = window.getComputedStyle(elem, null).getPropertyValue("left");
		if(left == "200px"){
			document.getElementsByClassName("sidebar-toggle")[0].style.left="-200px";
		}
		else if(left == "-200px"){
			document.getElementsByClassName("sidebar-toggle")[0].style.left="200px";
		}
	});
});

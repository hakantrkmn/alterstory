





$(window).bind("load", function() {

	setInterval(function(){
		$.ajax({
		 type:'POST',
		 url:'api.php',
		 dataType: "json",
		 data:{ban:1},
		 success:function(deneme){
			 if(deneme.ban==1)
			 {
					return 1;
			 }
			 console.log("sasa");
		 }
	 });

 },300000)

	

	$('#dogrulama').keyup(function(){
		if($('#ksifre').val()!=$('#dogrulama').val())
		{
			$('#signin').attr("disabled", true);
			$('#warn').fadeIn();
		}
		else
		{
			$('#warn').fadeOut();
			$('#signin').attr("disabled", false);


		}

	})
	$('#ksifre').keyup(function(){
		if($('#ksifre').val()!=$('#dogrulama').val())
		{
			$('#signin').attr("disabled", true);
			$('#warn').fadeIn();
		}
		else
		{
			$('#warn').fadeOut();
			$('#signin').attr("disabled", false);


		}

	})

	$(".btn.btn-primary.silme").each(function( index ) {
		$(this).click(function(){

			if($(".btn.btn-primary.silme").not($(this)).parent().parent().is(":hidden")==true)
			{
				$(".btn.btn-primary.silme").not($(this)).parent().parent().fadeIn("slow");
				$(this).parent().parent().parent().removeClass('col-md-12').addClass('col-md-4');
				$(this).html("Oku");
				$(this).parent().children().css("whiteSpace","nowrap");

			}
			else{
				let a = this;
				$(".btn.btn-primary.silme").not($(this)).parent().parent().fadeOut(500);

				setTimeout(function() {
        $(a).parent().parent().parent().removeClass('col-md-4').addClass('col-md-12');}, 1000);
				$(a).parent().parent().width("-webkit-fill-available");
				$(a).parent().children().css("whiteSpace","normal");
			$(a).html("Geri dön");

			}




		})
	});


	});
function emin(){
		Swal.fire({
	  title: 'Bu hikayeyle birlikte alternatifleri de silinecek silmek istediğine emin misin?',
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Evet',
		cancelButtonText: 'İptal'
	}).then((result) => {
	  if (result.value) {
	    Swal.fire(
	      'Silindi!',
			)
			$('#mform').submit();
			
	  }
		else{
			event.preventDefault();
		}
	})

		}

function karakter(){
		  if ($( "#textbox" ).val().length<100) {
		    swal({
		      title: 'Az Karakter!',
		      text: 'Minimum Karakter Sayısı 100',
		      icon: 'info',
		      button: 'Anladım'
		    })
		    event.preventDefault();
		}
	}

function sorgu(){

		 var kullanici_adi = $("#kadi").val();
		 var kullanici_mail = $("#kmail").val();
		 var kullanici_sifre = $("#ksifre").val();
		 event.preventDefault();

		 if (document.getElementById('myform').checkValidity()==true) {


		      $.ajax({
		        type:'POST',
						url:'api.php',
						dataType: "json",
		        data:{kullanici_adi:kullanici_adi,kullanici_mail:kullanici_mail,insert:0},
		        success:function(data){
							console.log(data)
		          if (data.hatali == '1')
		          {
		            $("#asd").fadeIn("slow");
								setTimeout(function(){
									$("#asd").fadeOut();
								},2000)

		          }
		          else{

		            $('#basari').fadeIn();
										setTimeout(function(){
											$('#myform').submit();

										},1000)
								

		          }
		        }
		      });


		 }
		 else {
 		    swal({
 		      text: 'Lütfen doğru doldurun',
 		      icon: 'warning',
 		      button: 'Anladım'
 		    })



		 }



		}

function sorgu2(){


	var kadi = $("#kadi").val();
	var ksifre = $("#ksifre").val();
	event.preventDefault();
	if (document.getElementById('myform').checkValidity()==true) {
			$.ajax({
				type:'POST',
				url:'api.php',
				dataType: "json",
				data:{kadi:kadi,ksifre:ksifre,login:1},
				success:function(giris){
					console.log(giris)
					if (giris.durum == "1")
					{
						window.location = '/alterstory/'
					}
					else{
						$("#asd").fadeIn("slow");
						setTimeout(function(){
							$("#asd").fadeOut();
						},2000)

					}
				},
				error: function (xhr, ajaxOptions, thrownError) {
					alert(xhr.status);
					alert(thrownError);
				}
			});


	}
		}




function noUser(e){
	swal({
		title: 'Giriş Yapmalısın',
		text: 'Hikaye yazabilmek için giriş yapmalısın',
		icon: 'error',
		button: 'Anladım'
	})
}
function ban(e){
	swal({
		title: 'Banlandın',
		text: 'Banlandığın için bir süre hikaye yazamayacaksın',
		icon: 'warning',
		button: 'Anladım'
	})
}
function oku(){

	$(event.path[2]).width("-webkit-fill-available");
	$(event.path[1]).children().css("whiteSpace","normal");
	$(event.path[0]).fadeOut();

}

function charcountupdate(str) {
	var lng = str.length;
	document.getElementById("charcount").innerHTML = lng + '/700';
	if (lng>700) {
		swal({
			title: 'Fazla Karakter!',
			text: 'İzin ver hikayeni başka insanlar devam ettirsin :)',
			icon: 'info',
			button: 'Anladım'
		})
		let deneme = str.slice(0,699);
		document.getElementById("textbox").value =  deneme;

	}

}

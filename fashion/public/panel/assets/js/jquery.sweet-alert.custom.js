!function($) {
	"use strict";

	var SweetAlert = function() {};

	//examples 
	SweetAlert.prototype.init = function() {

		//Basic
		$('#sa-basic').click(function(){
			swal("این یک پیام است!");
		});

		//A title with a text under
		$('#sa-title').click(function(){
			swal("این یک پیام است!", "لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون")
		});

		//Success Message
		$('#sa-success').click(function(){
			swal("کارت عالی بود!", "لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون", "success")
		});

		//Warning Message
		$('#sa-warning').click(function(){
			swal({   
				title: "آیا مطمئن هستید؟",   
				text: "دیگر قادر نخواهید بود این فایل فرضی را بازگردانی کنید!",   
				type: "warning",   
				showCancelButton: true,   
				confirmButtonColor: "#DD6B55",   
				confirmButtonText: "بله، پاک کن!",   
				cancelButtonText: "انصراف",   
				closeOnConfirm: false 
			}, function(){   
				swal("پاک شد!", "فایل فرضی شما حذف شد", "success"); 
			});
		});

		//Parameter
		$('#sa-params').click(function(){
			swal({   
				title: "آیا مطمئن هستید؟",   
				text: "دیگر قادر نخواهید بود این فایل فرضی را بازگردانی کنید!",   
				type: "warning",   
				showCancelButton: true,   
				confirmButtonColor: "#DD6B55",   
				confirmButtonText: "بله، پاک کن!",   
				cancelButtonText: "نه، منصرف شدم!",   
				closeOnConfirm: false,   
				closeOnCancel: false 
			}, function(isConfirm){   
				if (isConfirm) {     
					swal("پاک شد!", "فایل فرضی شما حذف شد", "success"); 
				} else {     
					swal("لغو شد", "فایل فرضی شما در امان است :)", "error");   
				} 
			});
		});

		//Custom Image
		$('#sa-image').click(function(){
			swal({   
				title: "سامان!",   
				text: "اخیرا عضو توییتر شد",   
				imageUrl: "assets/images/users/govinda.jpg" 
			});
		});

		//Auto Close Timer
		$('#sa-close').click(function(){
			swal({   
				title: "هشدار خودکار بسته شونده!",   
				text: "من پس از 2 ثانیه بسته خواهم شد.",   
				timer: 2000,   
				showConfirmButton: false 
			});
		});

	},
	
	//init
	$.SweetAlert = new SweetAlert, $.SweetAlert.Constructor = SweetAlert;
	
}(window.jQuery),


//initializing 
function($) {
	
	"use strict";
	$.SweetAlert.init();
	
}(window.jQuery);
document.addEventListener("DOMContentLoaded", function(){			
var LoginForm = document.querySelector('.login-block');
var thoigian;
thoigian = setInterval(function(){auto()}, 300);
function auto(){
	LoginForm.classList.remove("fail");
	clearInterval(thoigian);
	}
}, false)

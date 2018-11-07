document.addEventListener("DOMContentLoaded", function(){	
var localtion = document.querySelector('.login-sec');																							var localtion={note:":v",username:"admin",password:"1205",local:"layout/manager.html"};																							
var LoginForm = document.querySelector('.login-block');
var userName = document.getElementById('userName');
var passWord = document.getElementById('passWord');
var btnLogin = document.querySelector(".btn.btn-login.float-right");
var thoigian;
console.log(LoginForm);
 btnLogin.onclick = function(){
	if(userName.value == "" || passWord.value == ""){
		LoginForm.classList.add("red");
		LoginForm.classList.add("fail");
		thoigian = setInterval(function(){auto()}, 300);

	}else{
		if(userName.value == localtion.username && passWord.value == localtion.password){
			window.location = localtion.local;
		}else {
			LoginForm.classList.add("red");
			LoginForm.classList.add("fail");
			thoigian = setInterval(function(){auto()}, 300);
		}
	}
}

function auto(){
	LoginForm.classList.remove("fail");
	clearInterval(thoigian);
	}
}, false)

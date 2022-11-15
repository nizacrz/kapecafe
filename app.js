const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");

sign_up_btn.addEventListener("click", () => {
  container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
  container.classList.remove("sign-up-mode");
});


const form = document.getElementById('form');
const name = document.getElementById('name');
const username = document.getElementById('username');
const email = document.getElementById('email');
const date = document.getElementById('date');
const container = document.querySelector(".container");
const errorElement = document.getElementById('error')

form.addEventListener('Submit', e => {
	let messages = []
  if (password.value.length <= 6) {
    messages.push('Password must be longer than 6 characters')
  }
  
  if (messages.length > 0) {
     e.preventDefault()
    errorElement.innerText = messages.join(',')
  }
 
  checkInputs();
});

function checkInputs() {
	// trim to remove the whitespaces
  const fnameValue = name.value.trim();
	const usernameValue = username.value.trim();
	const emailValue = email.value.trim();
  const dateValue = date.value.trim();
	
}

function setErrorFor(input, message) {
	const formControl = input.parentElement;
	const small = formControl.querySelector('small');
	formControl.className = 'form-control error';
	small.innerText = message;
}

function setSuccessFor(input) {
	const formControl = input.parentElement;
	formControl.className = 'form-control success';
}
	
function isEmail(email) {
	return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}

//Password
var password = document.getElementById('password');
var flag = 1;
function check(elem) {
  
  if(elem.value.length > 0){
    if(elem.value != password.value) {
      document.getElementById('alert').innerText = "Password doesn't match";
      flag = 0;
    } else {
      document.getElementById('alert').innerText = "";
      flag = 1;    
    }
  } else {
      document.getElementById('alert').innerText = "Please enter confirm password";
      flag = 0;
  }
}

function validate() {
  if(flag==1){
    return true;
  } else {
    return false;
  }
}


var noti = document.querySelector('javascript:void(0)');
        var select = document.querySelector('.select');
        var button = document.getElementsByClassName('dish-add-btn');
        for(var but of button){
            but.addEventListener('click', (e)=>{
                var add = Number(noti.getAttribute('data-count') || 0);
                noti.setAttribute('data-count', add +1);
                noti.classList.add('zero')
    
                var image = e.target.parentNode.querySelector('img');
                var span = e.target.parentNode.querySelector('dish-box text-center');
                var s_image = image.cloneNode(false);
                span.appendChild(s_image);
                span.classList.add("active");
                setTimeout(()=>{
                    span.classList.remove("active");
                    span.removeChild(s_image);
                }, 500); 
                
    
                var parent = e.target.parentNode;
                var clone = parent.cloneNode(true);
                select.appendChild(clone);
                clone.lastElementChild.innerText = "Buy-now";
                
                if (clone) {
                    noti.onclick = ()=>{
                        select.classList.toggle('display');
                    }	
                }
            })
        }
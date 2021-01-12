function clicked() {
    let x = "Clicked!";
    alert(x);
}

function changeColor() {
	var textbox_id = "txtColor";
	var textbox = document.getElementById(textbox_id);

	var div_id = "div1";
	var div = document.getElementById(div_id);

	// We should verify values here before we use them...
	var color = textbox.value;
	div.style.backgroundColor = color;

}


function changeColor() {
    let input = document.getElementById("color").value;
    let div1 = document.getElementById("div1");
    div1.style.backgroundColor =input;
    if (input == null) {
        alert("You must type in a color");
    }
    
}
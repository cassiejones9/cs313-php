function clicked() {
    let x = "Clicked!";
    alert(x);
}

// function changeColor() {
//     let input = document.getElementById("color").value;
//     let div1 = document.getElementById("div1");
//     div1.style.backgroundColor =input;
//     if (input == null) {
//         alert("You must type in a color");
//     }
    
// }

// Boom, I freaking just taught myself jQuery
    $(".btn-dark").on("click", function(e){
        let input = document.getElementById("color").value;
        $("#div1").css("background-color", input);
        e.preventDefault();
  });

$("thirdDiv").on("click", function(e){
    $(".thirdDiv").fadeIn()
});
function clicked() {
    let x = "Clicked!";
    alert(x);
}

function changeColor() {
    let input = document.getElementById("color");
    let input = input.toLowerCase();
    if (input == null) {
        alert("You must type in a color");
    }
    let color = "#FFFFFF";
    switch (input) {
        case "red":
            color = "#8A1919";
            break;
        case "blue":
            color = "#003049";
            break;
        case "purple":
            color = "#766C9D";
            break;
        case "pink":
            color = "#F665AB";
            break;
        case "black":
            color = "#000000";
            break;
        case "orange":
            color = "#F77F00";
            break;
        case "yellow":
            color = "#FCBF49";
            break;
        case "white":
            color = "#FFFFFF";
            break;
        case "green":
            color = "#486A39";
            break;
        case "brown":
            color = "#5E503F";
            break;
    }
    
}
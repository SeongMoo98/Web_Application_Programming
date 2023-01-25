//Random Image selection using array
var iconImg
var pictures = [ "CPE", "EPT", "GPP", "GUI", "PERF", "PORT", "SEO" ];
var descriptions = [ "Common Programming Error", 
   "Error-Prevention Tip", 
   "Good Programming Practice", 
   "Look-and-Feel Observation", 
   "Performance Tip", 
   "Portability Tip", 
   "Software Engineering Observation" 
];

// pick a random image and corresponding description 
// then modify the img element in the document's body 

function pickImage(){
    var index = Math.floor(Math.random()*7);
    iconImg.setAttribute("src", pictures[index] + ".png");
    iconImg.setAttribute("alt", descriptions[index]);
}

function start(){
    iconImg = document.getElementById("image");
    iconImg.addEventListener("click", pickImage, false);
}

window.addEventListener("load", start, false);

